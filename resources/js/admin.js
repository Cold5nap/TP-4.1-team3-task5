import Categories from "./components/admin/Categories";
import {createApp} from "vue";
import { createRouter,createWebHistory } from "vue-router";
import Home from './components/admin/Home';
import AdminLayout from './components/admin/AdminLayout'
import 'bootstrap-icons/font/bootstrap-icons.css'
import Materials from "./components/admin/Materials";
import Products from "./components/admin/Products";
import Users from "./components/admin/Users";
import Orders from "./components/admin/Orders";
import Contacts from "./components/admin/Contacts";

require('./adminlte');


const router = new createRouter({
    history:createWebHistory(),
    routes:[
        {
            path:'/adm/home',
            name:'home',
            component:Home,
        },
        {
            path:'/adm/orders',
            name:'orders',
            component:Orders,
        },
        {
            path:'/adm/users',
            name:'users',
            component:Users,
        },
        {
            path:'/adm/products',
            name:'products',
            component:Products,
        },
        {
            path:'/adm/materials',
            name:'materials',
            component:Materials,
        },
        {
            path:'/adm/categories',
            name:'categories',
            component:Categories,
        },
        {
            path:'/adm/messages',
            name:'messages',
            component:Contacts,
        },
    ]
})

createApp(AdminLayout).use(router).mount('#admin-layout')
