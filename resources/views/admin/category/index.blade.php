@extends('layouts.admin-layout')

@section('title') Категории @endsection

@section('content')
<ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        <ul>
            @foreach ($category->childrenCategories as $childCategory)
                @include('admin.category.child_category', ['child_category' => $childCategory])
            @endforeach
        </ul>
    @endforeach
</ul>
@endsection('content')
