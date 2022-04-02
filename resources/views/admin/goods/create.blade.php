@extends('layouts.admin-layout')

@section('title') Добавление товара @endsection

@section('content')
    <div class="h3  py-3">Страница создания товара</div>
    <form class="row" action="/admin-panel/price-calculation/goods/" method="post" enctype="multipart/form-data">
        @csrf{{--защищенный ключ--}}
        <div class="col-3 form-group">
            <label for="name">Введите название</label>
            <input type="text" name="name" placeholder="Название" id="name" class="form-control">
        </div>
        <div class="col form-group">
            <label for="cost_price">Себестоимость</label>
            <input disabled type="text" name="cost_price" id="cost_price" class="form-control" value="">
            {{--Сделать с js высчитывание себестоимости композиции--}}
        </div>
        <div class="col form-group">
            <label for="markup">Введите наценку %</label>
            <input type="number" min="0" max="100" name="markup" placeholder="Наценка в процентах" id="markup" class="form-control">
        </div>
        <div class="col form-group">
            <label for="price">Цена композиции</label>
            <input type="text" name="price" placeholder="цена" id="price" class="form-control">
        </div>
        <div class="col-3 form-group">
            <label for="count_goods">Введите кол-во композиций</label>
            <input type="number" min="1" name="count_goods" placeholder="кол-во" id="count_goods"
                   class="form-control">
        </div>
        <div class="col-3 form-group">
            <label for="sum">Сумма за композиции</label>
            <input disabled type="text" name="sum" id="sum" class="form-control" value="">
            {{--Сделать с js высчитывание суммы композиции--}}
        </div>

        <div class="col-3 form-group">
            <label for="main_image">Выберите главное изображение</label>
            <input type="file" class="form-control-file" name="main_image" id="main_image">
        </div>

        <div class="col-6 form-group">
            <label for="other_images">Выберите изображения для подробного рассмотрения композиции</label>
            <input type="file" multiple class="form-control-file" name="other_images[]" id="other_images">
        </div>

        <div class="col-6 form-group border rounded">
            <div id="insertNewMaterial">
                <div id='0numberMaterial' class="numberMaterial row">
                    <div class="col-7 form-floating">
                        <input class='form-control' placeholder="Название материала" id='compositions_id' type="text"
                               name="composition[0][0]" list="compositionName">
                        <label for="compositions_id">Выберите материал</label>
                        <datalist id="compositionName">
                            @foreach($composition as $material)
                                <option value="{{$material->id}}">{{$material->name}}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col form-floating">
                        <input class="form-control" type="number" min="0" id="compositionNumber" name="composition[0][1]">
                        <label for="compositionNumber">Количество</label>
                    </div>
                    <div class="col">
                        <button id="0deleteButton" type="button" class='btn btn-sm btn-danger' onclick="deleteMaterial(this)">
                            <i class="bi bi-x-lg"></i></button>
                    </div>
                </div>


            </div>
            <button type="button" class="mt-2 btn-sm btn-success" onclick="addMaterial()">
                <i class="bi bi-plus"></i>
            </button>
        </div>
        <div class="col-4 form-group">
            <label for="description">Описание</label>
            <textarea rows="9" cols="45" name="description" placeholder="Описание товара" id="description"
                      class="form-control"></textarea>
        </div>

        <button type="submit" class="mt-2 btn btn-success">Добавить композицию</button>
    </form>
    <script src="{{asset('js/goods-create.js')}}"></script>
@endsection
