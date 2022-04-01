<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Composition;
use App\Models\Goods;
use App\Models\Goods_composition;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

//composition == material
class AdminCompositionController extends Controller
{

    public function index()
    {
        //получим материалы и их название картинки
        $compositions = DB::table('compositions')
        ->leftJoin('images', 'compositions.main_image_id', '=', 'images.id')
        ->select('compositions.id',
            'compositions.name',
            'compositions.price',
            'compositions.count_materials',
            'compositions.sum',
            'images.path as image_path')
        ->orderBy("compositions.id")->paginate(40);
        return view('admin.composition.index', compact('compositions'));
    }

    public function create()
    {
        //dd(Storage::disk('images')->)
        return view('admin.composition.create');
    }

    public function store(Request $request)
    {
        //сохраним уменьшенное изображение: сжатие 20%, размер 600:900, формат webp
        //средний размер изображений 28кб

        $image_req = $request->file('image');

        //добавляем к имени время создания
        date_default_timezone_set('europe/moscow');
        $image = saveImageInDBAndDisk($image_req,date("d.m.Y,H.i.s"));

        //добавили материал в бд
        $composition= new Composition();
        $composition->name = $request->input('name');
        $composition->count_materials = $request->input('count_materials');
        $composition->price = $request->input('price');
        $composition->sum = $request->input('sum');
        $composition->main_image_id = $image->id;
        $composition->save();

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


    public function destroy($id)
    {
        $message = "";

        // проверка что нет товаров с этим материалом
        if(Goods_composition::where('composition_id',$id)->exists()){
            $message='Чтобы удалить материал сначала удалите
            или отредактируйте состав товаров, которые ссылаются на этот материал.';
            return redirect('/admin-panel/price-calculation/goods')->with($message);
        }

        // получили записи из бд
        $composition = Composition::where('id',$id)->first();

        //удаление с диска и бд
        $message = deleteImageInDBAndDisk($composition->main_image_id);

        $composition->delete();
        return redirect('/admin-panel/price-calculation/composition')->with($message);
    }
}
