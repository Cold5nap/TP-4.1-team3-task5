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
            <th scope="col">Скидка</th>
            <th scope="col">Сумма</th>
            <th scope="col">Высота/Ширина</th>
            <th scope="col">Состав</th>
            <th scope="col">Категории</th>
            <th scope="col">Изображение</th>
            <th scope="col">Редактировать,удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{round($product->price * 100/(100 + $product->markup),2)}}</td>
                <td>{{$product->markup}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->number}}</td>
                <td>{{$product->discount}}</td>
                <td>{{$product->price * $product->number }}</td>
                <td>{{$product->size->height}}/{{$product->size->width}}</td>
                <td>@foreach($product->composition as $material)
                        {{$material->name}}<br>
                    @endforeach</td>
                <td>@foreach($product->categories as $category)
                {{$category->name}}<br>
                    @endforeach</td>
                <td><img height="30" src="{{$product->images->first()->path}}" alt="{{$product->images->first()->name}}"></td>
                <td>
                    <form action="/administrator/product/{{$product->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class='btn btn-sm btn-danger' type="submit"><i class="bi bi-x-lg"></i></button>
                    </form></td>
            </tr>
        @endforeach

        </tbody>
    </table>


    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
