<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Category_product;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/product",
     *     tags={"product"},
     *     summary="Returns sorted products",
     *     description="Returns ...",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\AdditionalProperties(
     *                 type="integer",
     *                 format="int32"
     *             )
     *         )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */
    public function index(Request $request)
    {
        $orderBy = 'created_at';
        $orderByType = 'desc';
        $startPrice = 0;
        $endPrice = 99999999;
        if ($request->has('start_price')) {
            $startPrice = $request->get('start_price');
        }
        if ($request->has('end_price')) {
            $endPrice = $request->get('end_price');
        }
        if ($request->has('order_by_type')) {
            $orderByType = $request->get('order_by_type');
        }
        if ($request->has('order_by')) {
            $orderBy = $request->get('order_by');
        }
        return ProductResource::collection(
            Product::whereHas('categories', function ($query) use ($request) {
                if ($request->has('categories')) {
                    $query->whereIn('categories.id', $request->get('categories'));
                }
            })->with('mainImage','size')
                ->whereBetween('price', [$startPrice, $endPrice])
                ->orderBy($orderBy, $orderByType)
                ->paginate(40));
    }
}
