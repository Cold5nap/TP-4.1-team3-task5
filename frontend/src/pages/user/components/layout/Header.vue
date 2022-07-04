<template>
  <header class="border-bottom">
    <div class="container header_top p-1 mb-0">
      <nav class="navbar navbar-light bg-ligh d-flex justify-content-center">
        <router-link
          :to="{ name: 'home' }"
          class="navbar-brand text-dark text-decoration-none mx-5"
        >
          <span class="navbar-brand">Fiori_VRN</span>
        </router-link>
        <ul class="nav nav-pills mx-5">
          <li class="nav-item">
            <a class="text-dark nav-link" href="tel:+73333333">+7 (333) 33-33</a>
          </li>
        </ul>

        <div class="input-group w-25">
          <button type="button" class="btn btn-warning">
            <i class="bi bi-search"></i>
          </button>
          <input
            type="search"
            class="form-control"
            placeholder="Поиск по сайту"
            aria-label="Поиск по сайту"
            aria-describedby="basic-addon1"
          />
        </div>

        <ul class="nav nav-pills">
          <li class="nav-item">
            <router-link :to="{ name: 'home' }" class="text-dark nav-link">Товары</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'constructor' }" class="nav-link text-dark"
              >Конструктор букетов</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'about' }" class="text-dark nav-link">Про нас</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'contact' }" class="text-dark nav-link">Контакты</router-link>
          </li>
          <!-- <li class="nav-item">
            <router-link :to="{ name: 'message' }" class="text-dark nav-link">Сообщение</router-link>
          </li> -->
          <li class="nav-item dropdown">
            <div
              :to="{ name: 'user' }"
              class="text-dark nav-link"
              id="drop"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              style="cursor: pointer"
            >
              <i class="bi bi-person-square h3 mx-2"></i>
              <span v-if="isLoggedIn">{{ name }}</span>
            </div>
            <ul class="dropdown-menu" aria-labelledby="drop">
              <li><a class="dropdown-item" style="cursor: pointer" @click="logout">Выйти</a></li>
              <li>
                <router-link to="/login" class="dropdown-item">Вход</router-link>
              </li>
              <li>
                <router-link to="/register" class="dropdown-item">Регистрация</router-link>
              </li>
              <li>
                <router-link to="/personal_information" class="dropdown-item">Кабинет</router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'favorite' }" class="text-dark nav-link">
              <i class="bi bi-bag-heart h3"></i>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'orders' }" class="text-dark nav-link">
              <i class="bi bi-box-seam h3"></i>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'basket' }" class="text-dark nav-link">
              <i class="bi bi-bag h3"></i>
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
import axios from "axios";
export default {
  name: "HeaderComponent",
  data() {
    return {
      isLoggedIn: false,
      name: null,
    };
  },
  created() {
    /* if (window.Laravel.isLoggedin) {
      this.isLoggedIn = true;
      this.name = window.Laravel.user.name;
    } */
  },
  methods: {
    logout(e) {
      console.log("ss");
      e.preventDefault();
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios
          .post("/api/logout")
          .then((response) => {
            if (response.data.success) {
              window.location.href = "/";
            } else {
              console.log(response);
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>
