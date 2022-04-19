@extends('layouts.admin-layout')

@section('title') Добавление материалов @endsection

@section('content')
    <form class="row" action="/administrator/category/" method="post" enctype="multipart/form-data">
        @csrf{{--защищенный ключ--}}

        <div class="col-3 form-group">
            <label for="name">Введите название</label>
            <input type="text" name="name" placeholder="Название" id="name" class="form-control">
        </div>


        <label for="parentCategory" class="form-label">Родительская категория</label>
       <select id="parentCategory" class='form-control form-select'name='parent_id'>
            <option value="0" selected>Нет родительской категории</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>


        <button type="submit" class="mt-2 btn btn-success">Добавить композицию</button>
    </form>
@endsection
