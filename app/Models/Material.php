<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    function image(){
        return $this->hasOne(MaterialImage::class);
    }

    function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
