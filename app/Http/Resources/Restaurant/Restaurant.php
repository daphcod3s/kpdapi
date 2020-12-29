<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Cuisine\CuisineCollection;

class Restaurant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'vendor' => new UserResource($this->owner),
            'cuisines' => new CuisineCollection($this->cuisines),
            'is_delivering_now' => $this->is_delivering_now,
            'image' => $this->getMedia('main_image')->first()->getUrl(),
        ];
    }
}
