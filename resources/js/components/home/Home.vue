<template>
    <div class="container-xxl my-md-4 bd-layout">
        <Carousel></Carousel>
        <div class="d-flex p-3">
            <div class="m-2 rounded shadow" style="background: #F2EDED;min-width:200px">
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
                        <input class="form-control" type="text" id="end" v-model="endPrice" @change="setEndPriceSlider">
                    </div>
                </div>

                <!--фильтр по категориям-->
                <ul class="list-unstyled mb-0 py-3 pt-md-1">
                    <CategoryFilter v-for="(category, index) in categories" :key="index" :category="category"
                        v-model="selectedCategories" @input="getProductByCategory()"></CategoryFilter>
                </ul>
            </div>

            <!--карточки товаров-->
            <div class="row">
                <!--Сортировка-->
                <div class="col mx-2">
                    <b>Сортировка по:</b>
                    <span style="cursor: pointer" @click="setDateOrder">
                        дате добавления
                        <i class="bi bi-arrow-up" v-if="orderBy === 'created_at' && orderByType === 'asc'"></i>
                        <i class="bi bi-arrow-down" v-if="orderBy === 'created_at' && orderByType === 'desc'"></i>
                        ,
                    </span>
                    <span style="cursor: pointer" @click="setPriceOrder">
                        цене
                        <i class="bi bi-arrow-up" v-if="orderBy === 'price' && orderByType === 'asc'"></i>
                        <i class="bi bi-arrow-down" v-if="orderBy === 'price' && orderByType === 'desc'"></i>
                    </span>
                </div>

                <main class="row row-cols-1 row-cols-md-3 g-4 m-0">
                    <Card v-for="(product, index) in products" :key="index" :product="product"></Card>
                    <!--спинер загрузки товаров-->
                    <div class="text-center" v-if="loading">
                        <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                            <span class="sr-only">Загрузка...</span>
                        </div>
                    </div>
                </main>
                <div class="m-2 justify-content-center">
                    <paginate v-model="currentPageProduct" :page-count="lastPageProduct"
                        :click-handler="getProductByCategory" :prev-text="'Предыдущая'" :next-text="'Следующая'"
                        :container-class="'pagination'" :page-class="'page-item'" :page-link-class="'page-link'"
                        :prev-link-class="'page-link'" :next-link-class="'page-link'">
                    </paginate>
                </div>
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
            loading: true,
            startPrice: 0,
            endPrice: 10000,
            selectedCategories: [],
            categories: [],
            products: [],
            currentPageProduct: 0,
            lastPageProduct: 1,
            orderBy: 'created_at',
            orderByType: 'desc',
        }
    },
    methods: {
        setDateOrder() {
            this.orderBy = 'created_at'
            if (this.orderByType === 'desc') {
                this.orderByType = 'asc';
            } else {
                this.orderByType = 'desc';
            }
            this.getProductByCategory()
        },
        setPriceOrder() {
            this.orderBy = 'price'
            if (this.orderByType === 'desc') {
                this.orderByType = 'asc';
            } else {
                this.orderByType = 'desc';
            }
            this.getProductByCategory()
        },
        setStartPriceSlider() {
            document.getElementById('slider').noUiSlider.set([this.startPrice, null]);
            this.getProductByCategory()
        },
        setEndPriceSlider() {
            document.getElementById('slider').noUiSlider.set([null, this.endPrice]);
            this.getProductByCategory()
        },
        setSlider() {
            let slider = document.getElementById('slider');

            noUiSlider.create(slider, {
                start: [this.startPrice, this.endPrice],
                connect: true,
                range: {
                    'min': this.startPrice,
                    'max': this.endPrice
                }
            })
            slider.noUiSlider.on('change', values => {
                this.startPrice = Math.round(Number(values[0]))
                this.endPrice = Math.round(Number(values[1]))
                this.getProductByCategory()
            });
        },
        setPaginationProduct(response) {
            this.currentPageProduct = response.data.meta.current_page;
            this.lastPageProduct = response.data.meta.last_page;
        },
        getProductByCategory(pageNumber = 1) {
            this.products = []
            this.loading = true
            let url = '/api/product?page=' + pageNumber;
            for (let key in this.selectedCategories) {
                url += '&categories[]=' + this.selectedCategories[key];
            }
            if (this.startPrice != null) {
                url += '&start_price=' + this.startPrice
            }
            if (this.endPrice != null) {
                url += '&end_price=' + this.endPrice
            }
            if (this.orderBy != null) {
                url += '&order_by=' + this.orderBy
            }
            if (this.orderByType != null) {
                url += '&order_by_type=' + this.orderByType
            }
            axios.get(url)
                .then(response => {
                    this.setPaginationProduct(response)
                    this.products = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        getCategories() {
            axios.get('/api/category')
                .then(response => {
                    this.categories = response.data

                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
    },
    components: {
        Carousel,
        Card,
        CategoryFilter,
    },
    mounted() {
        this.getProductByCategory();
        this.setSlider();
        this.getCategories();
    }
}
</script>
