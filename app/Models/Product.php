<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    function size(){
        return $this->hasOne(Size::class);
    }

    function mainImage(){
        return $this->hasOne(ProductImage::class)->where('is_main',true);
    }

    function images(){
        return $this->hasMany(ProductImage::class);
    }

    function categories(){
        return $this->belongsToMany(Category::class)
            ->withTimestamps();
    }

    function composition(){
        return $this->belongsToMany(Material::class,'composition')
            ->withPivot('number_material')
            ->withTimestamps();
    }

}
