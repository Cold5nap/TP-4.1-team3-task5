<template>
  <div class="container">
    <h3 class="m-4 text-center">Список желаний</h3>
    <div v-if="products.length > 0">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Товар</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Удалить</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <th scope="row">
              <img
                :src="product.mainImage.path"
                alt="product.mainImage.name"
                class="img"
                style="height: 70px; width: 70px"
              />
            </th>
            <td class="align-middle">
              <h5>{{ product.name }}</h5>
            </td>
            <td class="align-middle">{{ product.price }} руб.</td>
            <td class="align-middle">
              <i
                class="bi bi-bag-x h3"
                @click="deleteProduct(product.id)"
                style="cursor: pointer"
              ></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div
      v-if="products.length == 0 && !loading"
      class="bg-black bg-opacity-10 p-3 text-center rounded"
    >
      <h5>Список желаний пуст.</h5>
    </div>

    <div class="text-center" v-if="loading">
      <div class="spinner-border" style="width: 5rem; height: 5rem" role="status">
        <span class="sr-only">Загрузка...</span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "FavoriteView",
  data() {
    return {
      products: [],
      loading: false,
    };
  },
  methods: {
    deleteProduct(id) {
      let key = "productsIdInFavorite";
      let productsId = JSON.parse(localStorage.getItem(key));
      localStorage.setItem(key, JSON.stringify(productsId.filter((i) => i != id)));
      this.products = this.products.filter((p) => p.id != id);
    },
    getProductById(ids) {
      this.products = [];
      this.loading = true;
      let url = "/api/product_by_id";
      axios
        .get(url, {
          params: {
            product_ids: ids,
          },
        })
        .then((response) => {
          if (response.status == 200) {
            this.products = response.data.data;
            this.products.forEach((p) => (p.selectedNumber = 1));
          }
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        })
        .finally(() => (this.loading = false));
    },
  },
  mounted() {
    let ids = JSON.parse(localStorage.getItem("productsIdInFavorite"));
    this.getProductById(ids);
  },
};
</script>
