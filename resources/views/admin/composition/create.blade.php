@extends('layouts.admin-layout')

@section('title') Добавление материалов @endsection

@section('content')
    <form class="row" action="/admin-panel/price-calculation/composition/" method="post" enctype="multipart/form-data">
        @csrf{{--защищенный ключ--}}
        {{--доделать поля для создания goods--}}
        <div class="col-3 form-group">
            <label for="name">Введите название</label>
            <input type="text" name="name" placeholder="Название" id="name" class="form-control">
        </div>
        <div class="col form-group">
            <label for="price">Цена материала(1шт.)</label>
            <input type="text" name="price" placeholder="цена" id="price" class="form-control">
        </div>
        <div class="col-3 form-group">
            <label for="count_materials">Введите кол-во материалов</label>
            <input type="number" name="count_materials" placeholder="кол-во" id="count_materials" class="form-control">
        </div>
        <div class="col-3 form-group">
            <label for="sum">Сумма за материалы</label>
            <input type="text"  name="sum" placeholder="Сумма за материалы" id="sum" class="form-control">
        </div>

        <div class="col-3 form-group">
            <label for="image">Выберите изображение</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>

        <button type="submit" class="mt-2 btn btn-success">Добавить композицию</button>
    </form>
@endsection
