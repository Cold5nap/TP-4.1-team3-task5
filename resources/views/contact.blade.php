@extends('layouts.app')

@section('title')Контакты@endsection

@section('content')

    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-4 mx-0 mb-4">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Контакты</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-6 mb-lg-4">
            <h5 class="text-muted mb-lg-3">Напишите сообщение нашему администратору</h5>

            <form action="{{route('contact-form')}}" method="post">
                @csrf{{--защищенный ключ--}}
                <div class="form-group mb-lg-4">
                    <input type="text" name="name" placeholder="Имя" id="name" class="form-control">
                </div>
                <div class="form-group mb-lg-4">
                    <input type="text" name="email" placeholder="Email" id="email" class="form-control">
                </div>
                <div class="form-group mb-lg-4">
                    <input type="text" name="subject" placeholder="Tема" id="subject" class="form-control">
                </div>
                <div class="form-group mb-lg-4">
                    <textarea name="message" id="message" class="form-control" placeholder="Сообщение"></textarea>
                </div>
                <button type="submit" class="mt-2 btn text-dark " style="background: #ffc107">Отправить
                    сообщение
                </button>
            </form>
        </div>
        </div>
    </div>

@endsection
