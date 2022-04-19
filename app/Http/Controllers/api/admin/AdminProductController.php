<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::orderBy("id")->paginate(40));
    }

    public function create()
    {
        return ['materials'=>Material::all(), 'categories'=>Category::all()];
    }

    /**
     * Возращает к просмотру товаров.
     * Метод сохраняет изображения на диске, добавляет записи в таблицы.
     * Фотографии редактируются перед сохранением,
     * так же к их имени добавляется дата и порядковый номер для этой даты.
     *
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        //добавляем товар
        $product= new Product();
        $product->name = $request->input('name');
        $product->number = $request->input('number');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->markup = $request->input('markup');
        $product->discount = $request->input('discount');
        $product->save();

        //добавляем состав товара
        $compositions = [];
        $materials_id = $request->input('materials_id');
        $number_materials = $request->input('number_materials_id');
        for ($i = 0;$i<sizeof($materials_id);$i++){
            $compositions[$materials_id[$i]]=['number_material'=>$number_materials[$i]];
        }
        $product->composition()->attach($compositions);

        //добавляем изображения
        date_default_timezone_set('europe/moscow');
        $date = date("d-m-Y_H-i-s");
        $images=[];
        $imageCounter=1;

        //главное изображение
        $image_name_path = saveImageOnDisk($request->file('main_image'),$date, $imageCounter++);
        $mainImage = new ProductImage();
        $mainImage->name = $image_name_path['name'];
        $mainImage->path = $image_name_path['path'];
        $mainImage->is_main = true;
        $images[] = $mainImage;

        //изображения для подробного рассмотрения
        foreach ($request->file('images') as $imageRequest){
            $image_name_path = saveImageOnDisk($imageRequest,$date,$imageCounter++);
            $newImage = new ProductImage();
            $newImage->name = $image_name_path['name'];
            $newImage->path = $image_name_path['path'];
            $images[]=$newImage;
        }
        $product->images()->saveMany($images);

        //добавляем размеры
        $size = new Size();
        $size->height = $request->input('height');
        $size->width = $request->input('width');
        $product->size()->save($size);

        //добавляем категории
        if ($request->has('categories_id')) {
            $product->categories()->attach($request->input('categories_id'));
        }

        return response()->noContent();
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        //Удаляем изображения
        $images = $product->images()->get();
        $message = '';
        foreach ($images as $image){
            $message.= deleteImageOnDisk($image->name);
        }
        //изображения, размер удаляется каскадно при удалении товара
        //$images->delete();
        //$product->size()->delete();

        //удаляем состав
        $product->composition()->detach();
        //удаляем категории
        $product->categories()->detach();
        //удаляем товар
        $product->delete();

        return response()->noContent();
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
}
