<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function materials(){
        return $this->belongsToMany(Material::class,'order_material')->withPivot('number_materials');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_product')->withPivot('number_products');
    }
}
