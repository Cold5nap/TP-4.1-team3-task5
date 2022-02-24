<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Goods_shopping_cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function showGoods()
    {
        $goods = Goods::orderBy("id")->paginate(2);
        foreach ($goods as $item){
            $item['image']=Image::find($item->image_id);
        }
        return view('home',compact('goods'));
    }

    public function showOneGoods($id)
    {
        $item = Goods::find($id);
        $item['image']=Image::find($item->image_id);
        return view('one_goods',compact('item'));
        //переделать метод он не работает
    }

    public function addToShoppingCart(Request $request)
    {
        $goods= new Goods_shopping_cart();
        $goods->user_id = $request->input('user_id');
        $goods->goods_id = $request->input('goods_id');
        return redirect()->route('home')->with('success','Товар добавлен в корзину.');
    }
}
