<?php

namespace App\Http\Resources;

use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderMaterialResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'date'=>$this->date,
            'address'=>$this->address,
            'name_surname'=>$this->name_surname,
            'phone_number'=>$this->phone_number,
            'email'=>$this->email,
            'is_paid'=>$this->is_paid,
            'status'=>$this->status,
            'products'=> OrderProductResource::collection($this->products),
            'materials'=> OrderMaterialResource::collection($this->materials),
        ];
    }
}
