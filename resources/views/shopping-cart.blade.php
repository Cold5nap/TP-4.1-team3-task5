@extends('layouts.app')

@section('title') Корзина @endsection

@section('content')
    Корзина
    @foreach($goods as $good)
        <div class="d-flex flex-wrap">
            <div class="p-2">
                {{$good->name}} Цена {{$good->price}}
            </div>
        </div>
    @endforeach
@endsection
