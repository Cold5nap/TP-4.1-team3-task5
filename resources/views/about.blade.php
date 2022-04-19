@extends('layouts.app')

@section('title')Про нас@endsection

@section('content')

    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-lg-4 mx-0">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Про нас</li>
        </ol>
    </nav>


    <div class="container mt-lg-5">
        <div class="text-center">
            <img src="/images/Лого.png" height="300" width="450">
        </div>
        <div class="jumbotron p-3 p-md-5 text-black rounded bg-light">
            <blockquote class="blockquote text-center">
                <p class="lead my-3 text-muted"> Добро пожаловать в Flory vrn - магазин сухоцветов, который
                    предоставляет вам возможность
                    украсить свой дом нашими сухоцветами,придать изюминку фотосессии или сделать красивый
                    подарок.
                    В нашем магазине каждый сможет подобрать для себя сухоцветы по своему вкусу.

                <p class="lead my-3 text-muted"> Если вам нужна консультация или есть предложения о сотрудничестве, то
                    обращайтесь по
                    телефону, указанному в разделе «Контакты».</p>

                <p class="lead my-3 text-muted"> Мы будем рады ответить на любые ваши вопросы!</p>
            </blockquote>
        </div>
    </div>


@endsection
