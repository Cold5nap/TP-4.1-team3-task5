<template>

    <div class="card rounded m-2 shadow col p-0" style="width: 14rem; overflow: hidden">
        <router-link class="text-decoration-none text-black card-link"
            :to="{ name: 'product', params: { id: product.id, product: product } }">

            <img class="card-img " :src="product.mainImage.path" :alt="product.mainImage.name">

            <div class="card-img-overlay p-0 h-25">
                <div class="row">
                    <div class="col text-start">
                        <small v-if="product.discount > 0" class=" badge rounded-pill bg-danger ">{{ product.discount
                        }}%</small>
                    </div>
                    <div class="col text-end">
                        <small class="badge bg-black opacity-75 rounded">
                            {{ product.size.height }}см.
                            <i class="bi bi-arrow-left-right"></i>
                        </small>
                        <br>
                        <small class="bottom badge bg-black opacity-75 rounded">
                            {{ product.size.width }}см.
                            <i class="bi bi-arrow-down-up"></i>
                        </small>
                    </div>
                </div>
            </div>
        </router-link>

        <div class="card-body p-1">
            <router-link class="text-decoration-none text-black card-link" :to="{ path: '/product/' + product.id }">
                <h5 class="text-center">
                    {{ product.name }}
                </h5>
            </router-link>
            <div class="row">
                <OldPrice :price="product.price" :discount="product.discount"></OldPrice>
                <b class="col mx-2 text-end card-text ">{{ product.price }} руб.</b>
            </div>
            <div class="d-flex mt-1">

                <i v-if="isFavorite" @click="deleteFromFavorite()" class="bi bi-heart-fill h2 mx-2"
                    style="color:red;cursor: pointer"></i>
                <i v-else @click="addToFavorite()" class="bi bi-heart h2 mx-2" style="cursor: pointer"></i>

                <button v-if="inBasket" @click="deleteFromBasket()" type="button"
                    class="btn bg-black bg-opacity-10 text-dark container-fluid mx-2">
                    Удалить из корзины
                </button>
                <button v-else @click="addToBasket()" type="button"
                    class="btn btn-warning text-dark container-fluid mx-2">
                    В корзину
                </button>


            </div>
        </div>
    </div>
</template>

<script>
import OldPrice from '../OldPrice';
export default {
    name: "Card",
    props: {
        product: Object,
        isFavorite: Boolean,
        inBasket: Boolean,
    },
    components: {
        OldPrice
    },
    methods: {
        deleteFromFavorite() {

            let key = 'productsIdInFavorite'
            let productsId = JSON.parse(localStorage.getItem(key));
            localStorage.setItem(key, JSON.stringify(productsId.filter(i => i != this.product.id)))
            this.$emit('changeIsFavorite')
        },
        deleteFromBasket() {

            let key = 'productsIdInBasket'
            let productsId = JSON.parse(localStorage.getItem(key));
            localStorage.setItem(key, JSON.stringify(productsId.filter(i => i != this.product.id)))
            this.$emit('changeInBasket')
        },
        //поумолчанию два массива productsIdInBasket и productsIdInFavorite
        addToBasket() {
            let key = 'productsIdInBasket'
            let productsId = JSON.parse(localStorage.getItem(key));
            if (productsId == null) {
                productsId = []
                productsId.push(this.product.id)
                localStorage.setItem(key, JSON.stringify(productsId))
            } else if (!productsId.includes(this.product.id)) {
                productsId.push(this.product.id)
                localStorage.setItem(key, JSON.stringify(productsId))
            }
            this.$emit('changeInBasket')
            console.log(localStorage.getItem(key))
        },
        addToFavorite() {
            let key = 'productsIdInFavorite'
            let productsId = JSON.parse(localStorage.getItem(key));
            if (productsId == null) {
                productsId = []
                productsId.push(this.product.id)
                localStorage.setItem(key, JSON.stringify(productsId))
            } else if (!productsId.includes(this.product.id)) {
                productsId.push(this.product.id)
                localStorage.setItem(key, JSON.stringify(productsId))
            }
            this.$emit('changeIsFavorite')
            console.log(localStorage.getItem(key))
        },
    },
}
</script>
