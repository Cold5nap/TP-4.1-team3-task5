<template>
    <div class="container-xxl my-md-4 bd-layout">
        <Carousel></Carousel>
        <div class="d-flex p-3">
            <div class="m-2 rounded shadow"  style="background: #F2EDED;min-width:200px">
                <h4 class="m-2 mx-3">Фильтр</h4>

                <!--фильтр цен-->
                <p class="m-2 mx-3">Цена,руб</p>
                <div id="slider" class="m-3"></div>
                <div class="mx-3 d-flex justify-content-between" style="max-width: 200px">
                    <div class="">
                        <label for="start">От</label>
                        <input class="form-control" type="text" id="start" v-model="startPrice"
                               @change="setStartPriceSlider">
                    </div>
                    <div class="">
                        <label for="end">До</label>
                        <input class="form-control" type="text" id="end" v-model="endPrice"
                               @change="setEndPriceSlider">
                    </div>
                </div>

                <!--фильтр по категориям-->
                <ul class="list-unstyled mb-0 py-3 pt-md-1">
                    <CategoryFilter v-for="(category,index) in categories" :key="index" :category="category"
                                    v-model="selectedCategories" @input="pr"></CategoryFilter>
                </ul>
            </div>

            <!--карточки товаров-->
            <div class="row" >
                <!--Сортировка-->
                <div class="col mx-2">
                    <b>Сортировка по:</b>

                    <span style="cursor: pointer" @click="isNewestDate=!isNewestDate">
                        дате добавления
                    <i class="bi bi-arrow-up" v-if="isNewestDate"></i>
                    <i class="bi bi-arrow-down" v-if="!isNewestDate"></i>
                        ,
                    </span>

                    <span style="cursor: pointer" @click="isIncreasePriceSort=!isIncreasePriceSort">
                        цене
                    <i class="bi bi-arrow-up" v-if="isIncreasePriceSort"></i>
                    <i class="bi bi-arrow-down" v-if="!isIncreasePriceSort"></i>
                    </span>


                </div>
                <main class="row row-cols-1 row-cols-md-3 g-4 m-0">
                    <Card></Card>
                    <Card></Card>
                    <Card></Card>
                    <Card></Card>
                </main>
            </div>

        </div>


    </div>
</template>

<script>
import Carousel from './Carousel'
import Card from './Card'
import CategoryFilter from './CategoryFilter'
import noUiSlider from "../../nouislider.min"

export default {
    data() {
        return {
            isIncreasePriceSort:true,
            isNewestDate:true,
            startPrice:300,
            endPrice:3000,
            selectedCategories: [],
            categories: [
                {name: 'cat1', id: 1, subcategories: [{name: 'cate5', id: 5}, {name: 'cate6', id: 6}]},
                {name: 'cat2', id: 2, subcategories: [{name: 'cate7', id: 7}, {name: 'cate8', id: 8}]},
                {name: 'cat3', id: 3, subcategories: [{name: 'cate9', id: 9}, {name: 'cate10', id: 10}]},
                {name: 'cat4', id: 4, subcategories: [{name: 'cate12', id: 12}, {name: 'cate11', id: 11}]},
            ]
        }
    },
    methods: {
        setStartPriceSlider(){
            document.getElementById('slider').noUiSlider.set([this.startPrice, null]);
        },
        setEndPriceSlider(){
            document.getElementById('slider').noUiSlider.set([null, this.endPrice]);
        },
        slider() {
            let slider = document.getElementById('slider');

            noUiSlider.create(slider, {
                start: [300, 3000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 3000
                }
            })
            slider.noUiSlider.on('change',values => {
                this.startPrice = Math.round(Number(values[0]))
                this.endPrice = Math.round(Number(values[1]))
            });
        },
        pr() {
            console.log(this.selectedCategories)
        }
    },
    components: {
        Carousel,
        Card,
        CategoryFilter,
    },
    mounted() {
        this.slider();
    }
}
</script>
