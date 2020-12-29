<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Resources\Restaurant\Restaurant as RestaurantResource;
use App\Http\Resources\Restaurant\RestaurantCollection;
use DB;
use File;

class RestaurantController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
        $this->middleware('permission:add-restaurant', ['only' => ['store']]);
        $this->middleware('permission:update-restaurant', ['only' => ['update']]);
        $this->middleware('permission:delete-restaurant', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new RestaurantCollection(Restaurant::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'vendor' => 'required|integer',
                'phone' => 'required',
                'image' => 'required|image',
                'cuisine' => 'required'
            ]);

            DB::beginTransaction();

            $restaurant = Restaurant::create([
                'name' => $request->name,
                'vendor' => $request->vendor,
                'phone' => $request->phone
            ]);

            if($request->has('image')){
                $restaurant->addMediaFromRequest('image')->toMediaCollection('main_image');
            }

            $restaurant->cuisines()->attach($request->cuisine);

            DB::commit();

            return new RestaurantResource($restaurant);
        }catch(Exception $e){
            DB::rollback();
            return response()->json([
                "message" => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'vendor' => 'required|integer',
                'phone' => 'required',
                'image' => 'required|image',
                'cuisine' => 'required'
            ]);

            DB::beginTransaction();

            $restaurant->fill($request->only('name', 'vendor', 'phone'))->update();

            if($request->hasFile('image')){
                // $image = $restaurant->getMedia('main_image')->first()->getPath();
                // if(File::exists($image)){
                //     File::delete($image);
                // }
                $restaurant->clearMediaCollection('main_image');
                $restaurant->addMediaFromRequest('image')->toMediaCollection('main_image');
            }

            $restaurant->cuisines()->sync($request->cuisine);

            DB::commit();

            return new RestaurantResource($restaurant);
        }catch(Exception $e){
            DB::rollback();
            return response()->json([
                "message" => $e->getMessage()
            ], $e->getCode());
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->clearMediaCollection();
        $restaurant->delete();
        return response()->json([
            "message" => "Restaurant Deleted"
        ], 202);
    }
}
