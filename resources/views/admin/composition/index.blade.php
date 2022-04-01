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
            <th scope="col">Изображение</th>
            <th scope="col">Редактировать,удалить</th>
        </tr>
        </thead>
        <tbody>

@foreach($compositions as $composition)
    <tr>
        <td>{{$composition->name}}</td>
        <td>{{$composition->price}}</td>
        <td>{{$composition->count_materials}}</td>
        <td>{{$composition->sum}}</td>
        <td><img height="30" src="{{$composition->image_path}}" alt="{{$composition->name}}"></td>
    <td>
        <form action="/admin-panel/price-calculation/composition/{{$composition->id}}" method="post">
            @method('DELETE')
            @csrf
            <button class='btn btn-sm btn-danger' type="submit"><i class="bi bi-x-lg"></i></button>
        </form></td>
    </tr>
@endforeach

        </tbody>
    </table>


    <div class="d-flex justify-content-center">
        {{ $compositions->links('pagination::bootstrap-5') }}
    </div>
@endsection
