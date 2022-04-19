@extends('layouts.admin-layout')

@section('title') Материалы @endsection

@section('content')
    <h3>Материалы</h3>

    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
            <th scope="col">Сумма</th>
            <th scope="col">Категории</th>
            <th scope="col">Изображение</th>
            <th scope="col">Редактировать,удалить</th>
        </tr>
        </thead>
        <tbody>

@foreach($materials as $material)
    <tr>
        <td>{{$material->name}}</td>
        <td>{{$material->price}}</td>
        <td>{{$material->number}}</td>
        <td>{{$material->price*$material->number}}</td>
        <td>@foreach($material->categories as $category){{$category->name}}; @endforeach</td>
        <td><img height="30" src="{{$material->image->path}}" alt="{{$material->image->name}}"></td>
    <td>
        <form action="/administrator/material/{{$material->id}}" method="post">
            @method('DELETE')
            @csrf
            <button class='btn btn-sm btn-danger' type="submit"><i class="bi bi-x-lg"></i></button>
        </form></td>
    </tr>
@endforeach

        </tbody>
    </table>


    <div class="d-flex justify-content-center">
        {{ $materials->links('pagination::bootstrap-5') }}
    </div>
@endsection
