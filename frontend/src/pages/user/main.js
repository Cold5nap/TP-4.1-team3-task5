import { createApp } from "vue";
import Layout from "./components/layout/Layout";
import router from "./router";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import { createPinia } from "pinia";

const app = createApp(Layout);
app.config.globalProperties.ApiUrl = "http://127.0.0.1:8000";
app.use(router).use(createPinia()).mount("#app");
