import Vue from "vue";
import VueRouter from "vue-router";
import Paginate from 'vuejs-paginate';
import Layout from "./components/Layout/Layout";
import Contact from "./components/Contact";
import Constructor from "./components/Constructor";
import Home from "./components/home/Home";
import Message from "./components/Message";
import 'bootstrap-icons/font/bootstrap-icons.css'
import Show from "./components/Show";

require('./bootstrap');

Vue.component('paginate', Paginate)
Vue.use(VueRouter);

const router = new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/',
            name:'home',
            component:Home,
        },
        {
            path:'/contact',
            name:'contact',
            component:Contact,
        },
        {
            path:'/constructor',
            name:'constructor',
            component:Constructor,
        },
        {
            path:'/message',
            name:'message',
            component:Message,
        },
        {
            path:'/show',
            name:'show',
            component:Show,
        },

    ]
})

const appLayout = new Vue({
    el:'#layout',
    components:{Layout},
    router
})
