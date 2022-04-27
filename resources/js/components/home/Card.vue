<template>

    <div class="card rounded m-2 shadow col p-0" style="width: 14rem;overflow: hidden">
        <router-link class="text-decoration-none text-black card-link" :to="{path:'/product/'+product.id }">

            <img class="card-img "
                 :src="product.mainImage.path"
                 :alt="product.mainImage.name">

            <div class="card-img-overlay p-0 h-25">
                <div class="row">
                    <div class="col text-start">
                        <small class=" badge rounded-pill bg-danger ">{{product.discount}}%</small>
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
            <router-link class="text-decoration-none text-black card-link" :to="{path:'/product/'+product.id}"><h5 class="text-center">
                {{ product.name }}
            </h5></router-link>
            <div class="row">
                <span class="col mx-2 text-start text-muted card-text text-decoration-line-through">{{ Math.round(product.price*100/(100-product.discount)) }}руб.</span>
                <b class="col mx-2 text-end card-text ">{{ product.price }} руб.</b>
            </div>
            <div class="d-flex mt-1">

                <i class="bi bi-heart h2 mx-2" style="cursor: pointer"></i>
                <button type="submit" class="btn btn-warning text-dark container-fluid mx-2"> В
                    корзину
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Card",
    props: {
        product: Object,
    }
}
</script>

<style scoped>

</style>
