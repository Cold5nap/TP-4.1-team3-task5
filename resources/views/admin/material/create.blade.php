@extends('layouts.admin-layout')

@section('title') Добавление материалов @endsection

@section('content')
    <form class="row" action="/administrator/material/" method="post" enctype="multipart/form-data">
        @csrf{{--защищенный ключ--}}
        {{--доделать поля для создания goods--}}
        <div class="col-3 form-group">
            <label for="name">Введите название</label>
            <input value="test" type="text" name="name" placeholder="Название" id="name" class="form-control">
        </div>
        <div class="col form-group">
            <label for="price">Цена материала(1шт.)</label>
            <input value="3" type="text" onchange="
            document.getElementById('sum').value = this.value*document.getElementById('number').value
            " name="price" placeholder="цена" id="price" class="form-control">
        </div>
        <div class="col-3 form-group">
            <label for="number">Введите кол-во материалов</label>
            <input value="2" type="number" onchange="
            document.getElementById('sum').value = this.value*document.getElementById('price').value
            " name="number" placeholder="кол-во" id="number" class="form-control">
        </div>
        <div class="col-3 form-group">
            <label for="sum">Сумма за материалы</label>
            <input disabled type="text" name="sum" placeholder="Сумма за материалы"
                   id="sum" class="form-control">
        </div>

        <div class="col-3 form-group">
            <label for="image">Выберите изображение</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>

        <div class="col-3 form-group">
            <label for="categories_id">Выберите категории</label>
            <select multiple class="form-control form-select" name="categories_id[]" id="categories_id">
                @foreach($categories as $category)
                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="mt-2 btn btn-success">Добавить композицию</button>
    </form>
@endsection
