@extends('layouts.app')

@section('title') $data->subject @endsection

@section('content')
    Сообщения пользователя {{$data->name}}
    <p>Тема: {{$data->subject}}. Email: {{$data->email}}</p>
    <p>Время отправления: {{$data->created_at}}</p>
    <p>Сообщение: <div>{{$data->message}}</div></p>

@endsection
