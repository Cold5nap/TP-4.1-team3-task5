import { createRouter,createWebHistory } from "vue-router";
import Layout from "./components/Layout/Layout";
import Contact from "./components/Contact";
import Constructor from "./components/Constructor";
import Home from "./components/home/Home";
import Message from "./components/Message";
import Basket from "./components/Basket";
import 'bootstrap-icons/font/bootstrap-icons.css'
import Product from "./components/Product";
import { createApp } from 'vue';
import About from './components/About';
import User from './components/User';
import Favorite from './components/Favorite';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import Register from './components/Register';
import Orders from './components/Orders'
import PersonalInformation from './components/PersonalInformation'
import { VueReCaptcha } from 'vue-recaptcha-v3'

require('./bootstrap');

const router = new createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,

        },
        {
            path: '/constructor',
            name: 'constructor',
            component: Constructor,
        },
        {
            path: '/message',
            name: 'message',
            component: Message,
        },
        {
            path: '/product/:id',
            name: 'product',
            component: Product,
        },
        {
            path: '/basket',
            name: 'basket',
            component: Basket,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/user',
            name: 'user',
            component: User,
        },
        {
            path: '/favorite',
            name: 'favorite',
            component: Favorite,
        },
        {
            name: 'register',
            path: '/register',
            component: Register
        },
        {
            name: 'login',
            path: '/login',
            component: Login
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: Dashboard
        },
        {
            name: 'orders',
            path: '/order',
            component: Orders
        },
        {
            name: 'personal_information',
            path: '/personal_information',
            component: PersonalInformation
        },
    ]
})

const app = createApp(Layout).use(router).use(VueReCaptcha, { siteKey: '6LfsNjEgAAAAAJIwkezQOD8sE9eDVXcYT3YXCeTv' }).mount('#layout')
