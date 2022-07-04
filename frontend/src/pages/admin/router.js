import { createRouter, createWebHistory } from "vue-router";
import Categories from "./views/Categories";
import Home from "./views/Home";
import Materials from "./views/Materials";
import Products from "./views/Products";
import Users from "./views/Users";
import Orders from "./views/Orders";
import Contacts from "./views/Contacts";

const router = new createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/adm/home",
      name: "home",
      component: Home,
    },
    {
      path: "/adm/orders",
      name: "orders",
      component: Orders,
    },
    {
      path: "/adm/users",
      name: "users",
      component: Users,
    },
    {
      path: "/adm/products",
      name: "products",
      component: Products,
    },
    {
      path: "/adm/materials",
      name: "materials",
      component: Materials,
    },
    {
      path: "/adm/categories",
      name: "categories",
      component: Categories,
    },
    {
      path: "/adm/messages",
      name: "messages",
      component: Contacts,
    },
  ],
});

export default router;
