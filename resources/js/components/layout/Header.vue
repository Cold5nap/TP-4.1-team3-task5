<template>
  <header class="border-bottom">
    <div class="container header_top p-1 mb-0">
      <nav class="navbar navbar-light bg-ligh">
        <router-link :to="{ name: 'home' }" class="navbar-brand text-dark text-decoration-none">
          <span class="navbar-brand">Fiori_VRN</span>
        </router-link>
        <ul class="nav nav-pills">
          <li class="nav-item">
            <router-link :to="{ name: 'constructor' }" class="nav-link text-dark">Конструктор букетов</router-link>
          </li>
        </ul>
        <div class="input-group w-25">
          <button type="button" class="btn btn-warning">
            <i class="bi bi-search"></i>
          </button>
          <input type="search" class="form-control" placeholder="Поиск по сайту" aria-label="Поиск по сайту"
            aria-describedby="basic-addon1" />
        </div>

        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="text-dark nav-link" href="tel:+73333333">+7 (333) 33-33</a>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'about' }" class="text-dark nav-link">Про нас</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'contact' }" class="text-dark nav-link">Контакты</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'message' }" class="text-dark nav-link">Сообщение</router-link>
          </li>
          <li class="nav-item dropdown">

            <div :to="{ name: 'user' }" class="text-dark nav-link" id="drop" data-bs-toggle="dropdown"
              aria-expanded="false" style="cursor: pointer;">
              <i class="bi bi-person-square h3"></i>
              <span v-if="isLoggedIn">{{ name }}</span>
            </div>
            <ul class="dropdown-menu" aria-labelledby="drop">
              <li><a class="dropdown-item" style="cursor: pointer;" @click="logout">Logout</a></li>
              <li>
                <router-link to="/login" class="dropdown-item">login</router-link>
              </li>
              <li>
                <router-link to="/register" class="dropdown-item">Register</router-link>
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
import axios from 'axios'
export default {
  name: "Header",
  data() {
    return {
      isLoggedIn: false,
      name: null,
    }
  },
  created() {
    if (window.Laravel.isLoggedin) {
      this.isLoggedIn = true
      this.name = window.Laravel.user.name
    }
  },
  methods: {
    logout(e) {
      console.log('ss')
      e.preventDefault()
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/api/logout')
          .then(response => {
            if (response.data.success) {
              window.location.href = "/"
            } else {
              console.log(response)
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      })
    }
  },
}
</script>
