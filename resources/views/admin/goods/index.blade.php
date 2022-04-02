@extends('layouts.admin-layout')

@section('title') Товары @endsection

@section('content')
    <h3>Товары</h3>

    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Себестоимость</th>
            <th scope="col">Наценка</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
            <th scope="col">Сумма</th>
            <th scope="col">Изображение</th>
            <th scope="col">Редактировать,удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($goods as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->price * (100 - $item->markup)/100}}</td>
                <td>{{$item->markup}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->count_goods}}</td>
                <td>{{$item->count_goods * $item->price }}</td>
                <td><img height="30" src="{{$item->image_path}}" alt="{{$item->name}}"></td>
                <td>
                    <form action="/admin-panel/price-calculation/composition/{{$item->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class='btn btn-sm btn-danger' type="submit"><i class="bi bi-x-lg"></i></button>
                    </form></td>
            </tr>
        @endforeach

        </tbody>
    </table>


    <div class="d-flex justify-content-center">
        {{ $goods->links('pagination::bootstrap-5') }}
    </div>
@endsection
