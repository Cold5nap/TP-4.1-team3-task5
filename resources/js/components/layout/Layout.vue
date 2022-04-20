<template>
    <div>
        <Header></Header>
        <router-view></router-view>
        <Footer></Footer>
    </div>

</template>

<script>
import Header from "./Header";
import Footer from "./Footer";
import Breadcrumbs from "./Breadcrumbs";

export default {
    components:{
        Header,
        Footer,
        Breadcrumbs,
    }
}
</script>
