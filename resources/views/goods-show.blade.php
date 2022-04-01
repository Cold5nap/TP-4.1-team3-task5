@extends('layouts.app')

@section('content')
    Страничка товара

    <div class="border col w-25 p-3">
        <img class="img-fluid w-25 p-3"
             src="{{asset('images/'.$item->image->name.$item->image->extension)}}"
             alt="{{$item->name}}">
        {{$item->price}}
        @include('inc.forms.add-to-cart')


    </div>
@endsection

