<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Composition;
use App\Models\Goods;
use App\Models\Goods_composition;
use App\Models\Goods_images;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminGoodsController extends Controller
{
    public function index()
    {
        $goods = DB::table('goods')
            ->leftJoin('images', 'goods.main_image_id', '=', 'images.id')
            ->select('goods.id',
                'goods.name',
                'goods.price',
                'goods.markup',
                'goods.count_goods',
                'images.path as image_path')
            ->orderBy("goods.id")->paginate(40);
        return view('admin.goods.index', compact('goods'));
    }


    public function create()
    {
        return view('admin.goods.create',['composition'=>Composition::all()]);
    }


    public function store(Request $request)
    {
        date_default_timezone_set('europe/moscow');
        $date = date("d.m.Y,H.i.s");
        $i =0;

        $image = saveImageInDBAndDisk($request->file('main_image'),$date,$i++);

        //добавим товар в бд
        $goods = new Goods();
        $goods->name = $request->input('name');
        $goods->markup = $request->input('markup');
        $goods->price = $request->input('price');
        $goods->count_goods = $request->input('count_goods');
        $goods->description = $request->input('description');
        $goods->main_image_id = $image->id;
        $goods->save();

        //Добавили фотографии для подробного рассмотрения
        $images_req = $request->file('other_images');
        for (;$i<count($images_req);$i++) {

            $other_image = saveImageInDBAndDisk($images_req[$i], $date, $i);
            // добавляем в отношение товар-изображение
            //понять какой id возвращается для записи method insertgetid

            $goods_images = new Goods_images();
            $goods_images->image_id = $other_image->id;
            $goods_images->goods_id = $goods->id;
            $goods_images->save();
        }

        //добавить состав товара
        $compositions_req = $request->input('composition');
        foreach ($compositions_req as $comp_req) {

            $goods_composition = new Goods_composition();
            $goods_composition->composition_id = $comp_req[0];
            $goods_composition->goods_id = $goods->id;
            $goods_composition->number = $comp_req[1];
            $goods_composition->save();
        }
        return redirect('/admin-panel/price-calculation/composition')->with('success','Материал добавлен.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return
     */
    public function destroy($id)
    {
        $message = "";

        $goods = Goods::where('id',$id)->first();

        //удаление главного изображения
        $message = deleteImageInDBAndDisk($goods->main_image_id);

        // удаление изображений для подробного рассмотрения
        $goods_images = Goods_images::where('goods_id',$id)->get();
        foreach ($goods_images as $goods_image){
            deleteImageInDBAndDisk($goods_image->image_id);
        }
        $goods_images->delete();

        // доделать удаление связанных записей
        // оптимизировать удаления многих записей за раз

        $goods->delete();
        return redirect('/admin-panel/price-calculation/composition')->with($message);
    }
}
