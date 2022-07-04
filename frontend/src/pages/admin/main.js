import { createApp } from "vue";
import Layout from "./AdminLayout";
import router from "./router";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";

window.Laravel = "";
createApp(Layout).use(router).mount("#app");
