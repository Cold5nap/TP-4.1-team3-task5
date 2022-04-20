<template>
        <div class="container">
            <Carousel></Carousel>
            <div class="card-group">
                <Card></Card>
                <Card></Card>
                <Card></Card>
                <Card></Card>
            </div>
        </div>
</template>

<script>
import Carousel from './Carousel'
import Card from './Card'

export default {
    components:{
        Carousel,
        Card
    }
}
</script>
