<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'markup' => $this->markup,
            'price' => $this->price,
            'number' => $this->number,
            'discount' => $this->discount,
            'size' => SizeResource::make($this->size),
            'composition' => ProductMaterialResource::collection($this->composition),
            'categories' => CategoryResource::collection($this->categories),
            'mainImage' => ImagesResource::make($this->mainImage),
        ];
    }
}
