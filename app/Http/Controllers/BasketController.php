<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductBasketResource;

class BasketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('product_ids') != null) {
            return ProductBasketResource::collection(
                Product::with('mainImage')
                    ->whereIn('id', $request->get('product_ids'))
                    ->paginate(40)
            );
        } else {
            return response()->noContent();
        }
    }
}
