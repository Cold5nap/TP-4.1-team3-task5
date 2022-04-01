<?php

namespace App\Http\Controllers;

use App\Models\Goods_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        //
    }

    public function destroy($id)
    {
        //сделать route до store потом index, destroy
    }

    public function store(Request $request)
    {
        $goods_id = $request->input('goods_id');
        if (Auth::check()) {
            $goods_users = new Goods_users();
            $goods_users->goods_id = $goods_id;
            $goods_users->user_id = Auth::id();
            $goods_users->save();
        } else {
            if ($shopping_cart = session('shopping-cart')
                and !$shopping_cart->has($goods_id)) {

                $shopping_cart[] = $goods_id;
                session(['shopping-cart' => $shopping_cart]);
            } else {
                session('shopping-cart', [$goods_id]);
            }
            dd(session('shopping-cart'));
        }

        return back()->with('success', 'Товар был добавлен в корзину. Она находится в правом верхнем углу.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
