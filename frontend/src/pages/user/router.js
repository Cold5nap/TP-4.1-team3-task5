import { createRouter, createWebHistory } from "vue-router";
import Home from "./views/Home";
import Contact from "./views/Contact";
import Constructor from "./views/Constructor";
import Message from "./views/Message";
import Product from "./views/Product";
import Basket from "./views/Basket";
import About from "./views/About";
import User from "./views/User";
import Favorite from "./views/Favorite";
import Register from "./views/Register";
import Login from "./views/Login";
import Dashboard from "./views/Dashboard";
import Orders from "./views/Orders";

const router = new createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/contact",
      name: "contact",
      component: Contact,
    },
    {
      path: "/constructor",
      name: "constructor",
      component: Constructor,
    },
    {
      path: "/message",
      name: "message",
      component: Message,
    },
    {
      path: "/product/:id",
      name: "product",
      component: Product,
    },
    {
      path: "/basket",
      name: "basket",
      component: Basket,
    },
    {
      path: "/about",
      name: "about",
      component: About,
    },
    {
      path: "/user",
      name: "user",
      component: User,
    },
    {
      path: "/favorite",
      name: "favorite",
      component: Favorite,
    },
    {
      name: "register",
      path: "/register",
      component: Register,
    },
    {
      name: "login",
      path: "/login",
      component: Login,
    },
    {
      name: "dashboard",
      path: "/dashboard",
      component: Dashboard,
    },
    {
      name: "orders",
      path: "/order",
      component: Orders,
    },
  ],
});

export default router;
