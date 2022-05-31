<template>

    <div class="container my-5 ">

        <div class="row justify-content-center" v-if="!loading">
            <div class="col-lg-5">
                <div class="shadow">
                    <img :src="selectedImage.path" class="img-fluid shadow rounded" :alt="selectedImage.name">
                </div>
                <div>
                    <ul class="list-group list-group-horizontal overflow-auto mt-1 shadow">
                        <li style="min-height:: 10em; min-width: 8em;" class="list-group-item p-1" v-for="image in this.product.images" :key="image.name">
                            <img style="cursor: pointer;" :src="image.path" :alt="image.name"
                                @click="selectedImage = image" class="rounded shadow img-fluid">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <h1>{{ product.name }}
                    <span v-if="product.discount > 0" class="badge rounded-pill bg-danger ">{{ product.discount
                    }}%</span>
                </h1>
                <h3 class="mt-5">{{ product.price }} руб.<OldPrice :price="product.price" :discount="product.discount">
                    </OldPrice>
                </h3>

                <div class="row g-3 mt-2">
                    <div class="col-auto">
                        <input v-model="number" min=1 :max="product.number" type="number" class="form-control shadow">
                    </div>
                    <div class="col-auto">
                        <button @click="addToBasket" class="btn mb-3 shadow" style="background: #ffc107">В корзину</button>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-heart h2 mx-2" style="cursor: pointer"></i>
                    </div>
                </div>

                <hr class="featurette-divider mt-5">
                <h5>Параметры</h5>
                <p class="lead my-3 text-muted">
                    Высота: {{ product.size.height }} см<br>
                    Размер: {{ product.size.width }} см<br>
                </p>
                <h5>Состав</h5>
                <p class="lead my-3 text-muted">
                    <span v-for="(material, i) in product.composition" :key="i">
                        <span v-if="i > 0">, </span>
                        {{ material.name }}
                    </span>.
                </p>
                <h5>Описание</h5>
                <p class="lead my-3 text-muted">{{ product.description }}</p>
                <h5>Категории</h5>
                <p class="lead my-3 text-muted">
                    <span v-for="(category, i) in product.categories" :key="i"><span v-if="i > 0">, </span>{{
                            category.name
                    }}</span>.
                </p>
            </div>
        </div>

        <Spinner :loading="loading"></Spinner>

    </div>
</template>

<script>
import Spinner from './Spinner.vue';
import OldPrice from './OldPrice.vue';
export default {
    name: "ProductComponent",
    components: {
        Spinner,
        OldPrice,
    },
    data() {
        return {
            product: null,
            number: 1,
            loading: true,
            selectedImage: null,
        }
    },
    methods: {
        addToFavorite() { },
        addToBasket() {

        },
        getProduct() {
            axios.get('/api/product/' + this.$route.params.id)
                .then(response => {
                    this.product = response.data.data
                    this.setupSelectedImage()
                    console.log(this.product)
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        setupSelectedImage() {
            this.product.images.forEach(image => {
                if (image.isMain) {
                    this.selectedImage = image;
                }
            });
        },
    },
    mounted() {
        this.getProduct();

    },
}
</script>

