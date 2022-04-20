@extends('layouts.app')

@section('title') Flori_VRN @endsection

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide mt-5 mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img src="/images/5b589bf1061baecf53a614ed_20180725-IMG_5283.jpg" class="d-block " alt="..."
                     style="height: 500px; width: 1300px">
                <div class="carousel-caption d-none d-md-block">
                    <h4>Из отдельных сухоцветов можно составить монобукет или украсить ваш столик</h4>
                </div>
            </div>
            <div class="carousel-item ">
                <img src="/images/756372385988551.jpg" class="d-block " alt="..."
                     style="height: 500px; width: 1300px">
                <div class="carousel-caption d-none d-md-block">
                    <h4>Готовые композиции могут стать хорошим подарком
                        или изюминкой на фотосессии</h4>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/5b589bf1061baecf53a614ed_20180725-IMG_5283.jpg" class="d-block w-100" alt="..."
                     style="height: 500px; width: 1300px">
                <div class="carousel-caption d-none d-md-block">
                    <h4>Вы можете попробовать себя в роли флориста и составить свою уникальную композицию</h4>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button"
                data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

@endsection
