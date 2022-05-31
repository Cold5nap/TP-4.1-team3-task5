<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function materials(){
        return $this->belongsToMany(Material::class,'order_material')->withPivot('number_material');
    }
}
