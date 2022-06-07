<?php

namespace App\Http\Controllers\api\admin;

use SplFileInfo;
use Aws\S3\S3Client;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialImage;
use Aws\S3\MultipartUploader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\MaterialResource;
use App\Http\Requests\MaterialStoreRequest;
use Exception;

class AdminMaterialController extends Controller
{
    public function index()
    {
        return MaterialResource::collection(
            Material::with('image', 'categories')
                ->orderBy("id")
                ->paginate(40)
        );
    }

    public function create()
    {
        return CategoryResource::collection(Category::all());
    }
 
    public function store(MaterialStoreRequest $request)
    {
        try{
        //сохраняем изображение на яндекс диске
        $date = date("d.m.Y,H.i.s");
        date_default_timezone_set('europe/moscow');
        $image_req = $request->file('image');
        $namePath = saveImageOnDisk($image_req,$date);
        
        //добавляем материал
        $material = new Material();
        $material->name = $request->input('name');
        $material->number = $request->input('number');
        $material->price = $request->input('price');
        $material->save();

        //добавляем изображение
        $image = new MaterialImage();
        $image->name = $namePath['name'];
        $image->path = $namePath['path'];
        $material->image()->save($image);

        //добавляем категории
        if ($request->has('categories_id')) {
            $material->categories()->attach(array_values($request->input('categories_id')));
        }
    }catch(Exception $e){
        return response($e);
    }
        return MaterialResource::make($material);
    }

    public function destroy(Material $material)
    {
        $material->categories()->detach();
        $material->delete();
        return response()->noContent();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
