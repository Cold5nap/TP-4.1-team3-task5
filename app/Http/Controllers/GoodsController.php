<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Image;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index()
    {
        $goods = Goods::orderBy("id")->paginate(2);
        foreach ($goods as $item){
            $item['image']=Image::find($item->image_id);
        }
        return view('home',compact('goods'));
    }

    public function store(Request $request)
    {
        $goods= new Goods();
        $goods->name = $request->input('name');
        $goods->availability = $request->input('availability');
        $goods->price = $request->input('price');
        $goods->image_id = $request->input('image_id');
        $goods->save();
        return redirect('/')->with('success','Товар добавлен.');
    }

    public function show($id)
    {
        $item = Goods::find($id);
        $item['image']=Image::find($item->image_id);
        return view('goods-show',compact('item'));
    }

    public function create()
    {
        return view('admin.goods.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
