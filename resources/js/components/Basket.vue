<template>
  <div class="container ">
    <h3 class="m-4 text-center">Ваша корзина</h3>
    <div v-if="products.length > 0">
      <table class="table  table-hover">
        <thead>
          <tr>
            <th scope="col">Товар</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
            <th scope="col">Сумма</th>
            <th scope="col">Удалить</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <th scope="row"><img :src="product.mainImage.path" alt="..." class="img" style="height: 70px; width: 70px;">
            </th>
            <td class="align-middle">
              <h5>{{ product.name }}</h5>
            </td>
            <td class="align-middle">{{ product.price }} руб.</td>
            <td class="align-middle">
              <input type="number" class="form-control" v-model="product.selectedNumber" style="width: 60px;">
            </td>
            <td class="align-middle">{{ product.price * product.number }} руб.</td>
            <td class="align-middle">
              <i class="bi bi-bag-x h3" @click="deleteProduct(product.id)" style="cursor: pointer;"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row justify-content-center rounded bg-black bg-opacity-10">
        <h5 class="text-center mb-3">Заполните данные о заказе, чтобы произвести его.</h5>

        <div class="mb-3 col-auto">
          <label class="form-label" for="nameSurname">Введите имя и отчество</label>
          <input type="text" class="form-control" id="nameSurname" placeholder="имя отчество" v-model="nameSurname">
        </div>
        <div class="mb-3 col-auto">
          <label class="form-label" for="email">Введите Email</label>
          <input type="text" class="form-control" id="email" placeholder="email@ya.ru" v-model="email">
        </div>
        <div class="mb-3 col-auto">
          <label class="form-label" for="phoneNumber">Введите номер телефона</label>
          <input v-model="phoneNumber" type="text" class="form-control" id="phoneNumber" placeholder="89009009090">
        </div>
        <div class="mb-3 col-auto">
          <label class="form-label" for="address">Введите адрес доставки</label>
          <input v-model="address" type="text" class="form-control" id="address"
            placeholder="Улица, дом или квартира, подъезд, этаж">
        </div>
        <div class="mb-3 col-auto">
          <label class="form-label" for="date">Выберите дату и время доставки</label>
          <input v-model="date" class="form-control" type="datetime-local" id="date">
        </div>
        <div class="mb-3 col-auto">
          <label class="form-label" for="description">Ваши пожелания</label>
          <textarea class="form-control" rows="3" cols="40" v-model="description" id="description"></textarea>
        </div>
        <div class="mb-3 col-auto">Сборные заказы требуют точного изложения ваших желаний,
          поэтому мы позвоним вам для его уточнения и подтверждения.</div>
        <button type="button" class="btn btn-warning" @click="recaptcha()">Произвести заказ</button>
      </div>
    </div>

    <div v-if="products.length == 0 && !loading" class="bg-black bg-opacity-10 p-3 text-center rounded">
      <h5>В корзине товаров нет.</h5>
    </div>

    <div class="text-center" v-if="loading">
      <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
        <span class="sr-only">Загрузка...</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BasketComponent",
  data() {
    return {
      products: [],
      currentPage: null,
      lastPage: null,
      phoneNumber: "111111",
      address: "dddddddddd",
      nameSurname: "sssssssssssss",
      date: '2022-05-31 17:14:52',
      description: "aaaaaaaaaaaaasdfasdfasdfasdf",
      email: "aaaaaaaa",
      loading:false,
    }
  },
  methods: {
    recaptcha() {
      this.$recaptchaLoaded().then(() => {
        this.$recaptcha('login').then(token => {
          console.log(JSON.stringify({
            selected_products: this.products,
            name_surname: this.nameSurname,
            address: this.address,
            phone_number: this.phoneNumber,
            email: this.email,
            date: this.date,
            description: this.description,
            token: token,
          }))
          this.postOrder(token)
        })
      })
    },
    postOrder(token) {
      axios.post('/api/order/product', {
        selected_products: this.products,
        name_surname: this.nameSurname,
        address: this.address,
        phone_number: this.phoneNumber,
        email: this.email,
        date: this.date,
        description: this.description,
        token: token,
      }, { headers: { 'Content-Type': 'application/json' } }
      )
        .then(response => {
          if (response.status == 204) {
            alert('Ваш заказ принят и будет рассмотрен.')
          } else {
            alert('Заказ не принят.')
          }
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
    },
    deleteProduct(id) {
      let key = 'productsIdInBasket'
      let productsId = JSON.parse(localStorage.getItem(key));
      localStorage.setItem(key, JSON.stringify(productsId.filter(i => i != id)))
      this.products = this.products.filter(p => p.id != id)
    },
    postOrder() {

    },
    setPaginationProduct(response) {
      this.currentPage = response.data.meta.current_page;
      this.lastPage = response.data.meta.last_page;
    },
    getProductById(ids) {
      this.products = []
      this.loading = true
      let url = '/api/basket';
      axios.get(url, {
        params: {
          product_ids: ids
        },
      })
        .then(response => {
          if (response.status == 200) {
            this.setPaginationProduct(response)
            this.products = response.data.data
            this.products.forEach(p => p.selectedNumber = 1)
          }
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
        .finally(() => this.loading = false)
    },
  },
  mounted() {
    let ids = JSON.parse(localStorage.getItem('productsIdInBasket'))
    this.getProductById(ids)


  },
};
</script>