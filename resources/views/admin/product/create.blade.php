@extends('layouts.admin-layout')

@section('title') Добавление товара @endsection

@section('content')
    <div class="h3  py-3">Страница создания товара</div>
    <form class="row" action="/administrator/product/" method="post" enctype="multipart/form-data">
        @csrf{{--защищенный ключ--}}
        <div class="col-3 form-group rounded border m-1 bg-black bg-opacity-10 bg-black bg-opacity-10 ">
            <label class="text-black" for="name">Введите название</label>
            <input value="test" type="text" name="name" placeholder="Название" id="name" class="form-control">
        </div>
        <div class="col form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="cost_price">Себестоимость</label>
            <input disabled type="text" name="cost_price" id="cost_price" class="form-control" value="">
            {{--Сделать с js высчитывание себестоимости композиции--}}
        </div>
        <div class="col form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="markup">Введите наценку %</label>
            <input value="1" type="number" min="0" name="markup" placeholder="Наценка в процентах" id="markup" class="form-control">
        </div>
        <div class="col-2 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="price">Цена композиции</label>
            <input value="1" type="text" name="price" placeholder="цена" id="price" class="form-control">
        </div>
        <div class="col-3 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="count_goods">Введите кол-во композиций</label>
            <input value="1" type="number" min="1" name="number" placeholder="кол-во" id="count_goods"
                   class="form-control">
        </div>
        <div class="col-2 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="sum">Сумма за композиции</label>
            <input disabled type="text" name="sum" id="sum" class="form-control" value="">
            {{--Сделать с js высчитывание суммы композиции--}}
        </div>
        <div class="col-1 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="discount">Скидка</label>
            <input value="1" type="text" name="discount" id="discount" class="form-control" >
            {{--Сделать с js высчитывание суммы композиции--}}
        </div>

        <div class="col-3 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="main_image">Выберите главное изображение</label>
            <input type="file" class="form-control form-control-file text-black" name="main_image" id="main_image">
        </div>

        <div class="col-3 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="images">Выберите остальные изображения</label>
            <input type="file" multiple class="form-control form-control-file text-black" name="images[]" id="images">
        </div>

        <div class="col-4 form-group border m-1 bg-black bg-opacity-10  rounded">
            <div id="insert-new-material">
                <label class="text-black">Материалы</label>
                <div id='0' class="number-material row">

                    <div class="col-7 form-floating">
                        <select class="form-control form-select" name="materials_id[]" id="materials_id">
                            @foreach($materials as $material)
                                <option value="{{$material->id}}">{{$material->name}}</option>
                            @endforeach
                        </select>
                        <label class="text-black" for="materials_id">Выберите материал</label>
                    </div>

                    <div class="col form-floating">
                        <input value="1" class="form-control" type="number" min="0" id="compositionNumber" name="number_materials_id[]">
                        <label class="text-black" for="compositionNumber">Количество</label>
                    </div>

                    <div class="col">
                        <button id="delete-button" type="button" class=' btn btn-sm btn-danger' onclick="deleteRow(this)">
                            <i class="bi bi-x-lg"></i></button>
                    </div>

                </div>
            </div>
            <button type="button" class="mt-2 btn-sm btn-success" onclick="addMaterial()">
                <i class="bi bi-plus"></i>
            </button>
        </div>

        <div class="col-4 form-group border m-1 bg-black bg-opacity-10  rounded">
            <label class="text-black" for="categories_id">Выберите категорию</label>
            <select multiple class="form-control form-select" name="categories_id[]" id="categories_id">
                @foreach($categories as $category)
                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-1 form-group rounded border m-1 bg-black bg-opacity-10 ">
            <label class="text-black" for="height">Высота</label>
            <input value="30" type="number" name="height" id="height" class="form-control" >
            <label class="text-black" for="width">Ширина</label>
            <input value="40" type="number" name="width" id="width" class="form-control" >
            {{--Сделать с js высчитывание суммы композиции--}}
        </div>

        <div class="col-10 form-group rounded border m-1 bg-black bg-opacity-10">
            <label class="text-black" for="description">Описание</label>
            <textarea rows="9" cols="100" name="description" placeholder="Описание товара" id="description"
                      class="form-control">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</textarea>
        </div>

        <button type="submit" class="mt-2 btn btn-success">Добавить композицию</button>
    </form>
    <script src="{{asset('js/goods-create.js')}}"></script>
@endsection
