<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialStoreRequest;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\MaterialResource;
use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialImage;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    public function index()
    {
        return MaterialResource::collection(Material::orderBy("id")
            ->paginate(40));
    }

    public function create()
    {
        return CategoriesResource::collection(Category::all());
    }

    public function store(MaterialStoreRequest $request)
    {
        //добавляем материал
        $material= new Material();
        $material->name = $request->input('name');
        $material->number = $request->input('number');
        $material->price = $request->input('price');
        $material->save();

        //добавляем изображение
        date_default_timezone_set('europe/moscow');
        $image_name_path = saveImageOnDisk($request->file('image'),date("d.m.Y,H.i.s"));
        $image = new MaterialImage();
        $image->name = $image_name_path['name'];
        $image->path = $image_name_path['path'];
        $material->image()->save($image);

        //добавляем категории
        if ($request->has('categories_id')) {
            $material->categories()->attach(array_values($request->input('categories_id')));
        }
        return MaterialResource::make($material);
    }

    public function destroy(Material $material)
    {
        deleteImageOnDisk($material->image->name);
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
