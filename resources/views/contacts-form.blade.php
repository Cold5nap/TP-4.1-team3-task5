@extends('layouts.app')

@section('title')Контакты@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            Напишите нам:
            <form action="/contacts" method="post">
                @csrf{{--защищенный ключ--}}

                <div class="form-group">
                    <label for="name">Введите имя</label>
                    <input type="text" name="name" placeholder="Имя" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Введите email</label>
                    <input type="text" name="email" placeholder="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="subject">Введите тему сообщения</label>
                    <input type="text" name="subject" placeholder="тема" id="subject" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">Введите сообщение</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Сообщение"></textarea>
                </div>
                <button type="submit" class="mt-2 btn btn-success">Отправить сообщение</button>
            </form>
        </div>
        <div class="col">

        </div>
    </div>

@endsection
