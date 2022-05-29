<template>
    <span v-if="discount > 0" class="col mx-2 text-start text-muted card-text text-decoration-line-through">{{
            Math.round(price * 100 / (100 - discount))
    }}руб.</span>
</template>
<script>
export default {
    name: 'OldPriceComponent',
    props:['discount', 'price'],
}
</script>