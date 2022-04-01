@extends('layouts.app')

@section('title') Сообщения пользователей @endsection

@section('content')
    Сообщения пользователей
    @foreach($data as $row)
        <div class="alert alert-info">
            <p>Тема: {{$row->subject}}.  Email: {{$row->email}}</p>
            <p>Время отправления:{{$row->created_at}}</p>
            <a href="/contacts/{{$row->id}}"><button class="btn btn-warning">Детальнее</button></a>
        </div>
    @endforeach
@endsection
