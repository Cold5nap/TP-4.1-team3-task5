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

    /**
     * Возращает к просмотру товаров.
     * Метод сохраняет изображения на диске, добавляет записи в таблицы
     * goods, goods_composition, goods_images, images.
     * Фотографии редактируются перед сохранением,
     * так же к их имени добавляется дата и порядковый номер для этой даты.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        date_default_timezone_set('europe/moscow');
        $date_file = date("d-m-Y_H-i-s");
        $date_db = date("Y-m-d H:i:s");
        $image_counter =0;

        //добавим главное изображение на диск и в бд
        $image = saveImageInDBAndDisk($request->file('main_image'),$date_file,$image_counter++);

        //добавим товар в бд
        $goods = new Goods();
        $goods->name = $request->input('name');
        $goods->markup = $request->input('markup');
        $goods->price = $request->input('price');
        $goods->count_goods = $request->input('count_goods');
        $goods->description = $request->input('description');
        $goods->main_image_id = $image->id;
        $goods->save();

        //Добавим фотографии для подробного рассмотрения
        $images_req = $request->file('other_images');
        $images_insert=[];//матрица, где ряд - данные о вставляемой записи
        $goods_images=[];// массив хранящий id изображения для добавления в отношение товар-изображение
        $last_image_id = Image::latest()->first()->id;
        foreach ($images_req as $image_req){
            //сохраняем отредактированное изображение на диске и получаем название, путь и расширение файла
            $parameters = saveImageOnDisk($image_req,$date_file,$image_counter++);
            $parameters['created_at']=$date_db;
            $parameters['updated_at']=$date_db;
            $images_insert[]=$parameters;
            $goods_images[] = [
                'image_id'=> ++$last_image_id,
                'goods_id'=>$goods->id,
                'created_at'=>$date_db,
                'updated_at'=>$date_db];
        }
        DB::table('images')->insert($images_insert);//добавили изображения в бд
        DB::table('goods_images')->insert($goods_images);//добавили изображения в бд отношение товар-изображение

        //добавим состав товара
        $compositions_req = $request->input('composition');
        $goods_compositions= [];
        foreach ($compositions_req as $comp_req) {
        $goods_compositions[]=[
            'composition_id'=>$comp_req[0],
            'goods_id'=>$goods->id,
            'number'=>$comp_req[1],
            'created_at'=>$date_db,
            'updated_at'=>$date_db];
        }
        DB::table('goods_compositions')->insert($goods_compositions);//добавили в бд в отношение товары состав

        return redirect('/admin-panel/price-calculation/goods')->with('success','Материал добавлен.');

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
