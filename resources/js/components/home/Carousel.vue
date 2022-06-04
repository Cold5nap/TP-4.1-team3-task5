<template>
    <div id="carouselExampleCaptions" class="carousel slide  m-4 shadow" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/слайдер1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block " style="text-shadow: black 0 0 4px;">
                    <h5 class="">Готовые композиции могут стать хорошим подарком
                        или изюминкой на фотосессии.</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/слайдер2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block " style="text-shadow: black 0 0 4px;">
                    <h5>Вы можете попробовать себя в роли флориста и составить свою уникальную композицию.</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/слайдер3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block " style="text-shadow: black 0 0 4px;">
                    <h5>Создайте уютную обстановку из наших композиций для комфортной работы.</h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>

<script>
export default {
    name: "carousel"
}
</script>

<style scoped>
</style>
