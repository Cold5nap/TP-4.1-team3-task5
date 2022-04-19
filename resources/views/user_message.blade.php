@extends('layouts.app')

@section('title') Каталог@endsection

@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-lg-4 mx-0">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Каталог</li>
        </ol>
    </nav>

    <div class="container-fluid mx-lg-4 mt-lg-5 mb-lg-5">
        <div class="card" style="width: 18rem;">
            <img class="card-img" src="/images/test.png" alt="Card image cap">
            <div class="card-img-overlay">
                <p class="card-text text-white bg-warning"> Размер букета 50 см.</p>
            </div>

            <div class="card-body">
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">50%
                    <span class="visually-hidden">скидка</span>
                  </span>

{{--                <span class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-warning">Размер 50 см--}}

{{--                  </span>--}}

                <h5 class="card-title">Название карточки</h5>
                <p class="card-text">700 р.</p>


                <button type="submit" class="mt-2 btn text-dark " style="background: #ffc107"> В корзину
                </button>
                <a href="#" class="card-link ">
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart " fill="#3E3C3C"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                </a>

            </div>
        </div>
    </div>


@endsection
