<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;
use App\Http\Resources\Cuisine\Cuisine as CuisineResource;

class CuisineController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
        $this->middleware('permission:list-cuisine', ['only' => ['index']]);
        $this->middleware('permission:show-cuisine', ['only' => ['show']]);
        $this->middleware('permission:add-cuisine', ['only' => ['store']]);
        $this->middleware('permission:update-cuisine', ['only' => ['update']]);
        $this->middleware('permission:delete-cuisine', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CuisineResource(Cuisine::active()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30'
        ]);

        $cuisine = Cuisine::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id
        ]);
        return new CuisineResource($cuisine);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function show(Cuisine $cuisine)
    {
        return new CuisineResource($cuisine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuisine $cuisine)
    {
        $request->validate([
            'name' => 'required|string|max:30'
        ]);
        $cuisine->name = $request->name;
        $cuisine->update();
        return new CuisineResource($cuisine);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuisine $cuisine)
    {
        $cuisine->delete();
        return response()->json([
            "message" => "Cuisine Deleted"
        ], 202);
    }
}
