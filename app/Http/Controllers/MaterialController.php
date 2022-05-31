<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialResource;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        return MaterialResource::collection(
            Material::whereHas('categories', function ($query) use ($request) {
                if ($request->has('categories')) {
                    $query->whereIn('categories.id', $request->get('categories'));
                }
            })->orderBy('name', 'asc')
                ->get()
        );
    }
}
