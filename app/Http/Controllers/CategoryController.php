<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=CategoriesResource::collection(Category::with('categories')->get());
        $categoriesWithoutChild = [];
        foreach ($categories as $category){
            if (count($category['categories'])>0){
                $categoriesWithoutChild[] = $category;
            }
        }
        return $categoriesWithoutChild;
    }
}
