<template>
  <div class="container-xxl my-md-4 bd-layout">
    <h4 class="text-center mb-3">Конструктор составления композиции</h4>

    <div class="row p-3 justify-content-center rounded bg-black-10">
      <div class="col-auto">
        <input
          type="radio"
          class="visually-hidden form-check-input"
          v-model="tab"
          value="constructor"
          id="constructorTab"
        />
        <label
          style="cursor: pointer"
          class="form-check-label"
          for="constructorTab"
          :class="{ 'badge badge bg-warning text-black': tab === 'constructor' }"
        >
          <h5>Выбор материалов для композиции</h5>
        </label>
      </div>
      <div class="col-auto">
        <h5><i class="bi bi-arrow-left-right"></i></h5>
      </div>
      <div class="col-auto">
        <input
          type="radio"
          class="visually-hidden form-check-input"
          v-model="tab"
          value="order"
          id="orderTab"
        />
        <label
          style="cursor: pointer"
          class="form-check-label"
          for="orderTab"
          :class="{ 'badge badge bg-warning text-black': tab === 'order' }"
        >
          <h5>Заказ</h5>
        </label>
      </div>
    </div>

    <!-- Часть страницы про заказ -->
    <div v-show="tab === 'order'" class="row p-3 justify-content-center">
      <div class="row justify-content-center" v-if="selectedMaterials.length > 0">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Название материала</th>
              <th scope="col">Цена</th>
              <th scope="col">Кол-во</th>
              <th scope="col">Сумма</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="material in selectedMaterials" :key="material.name">
              <td>{{ material.name }}</td>
              <td>{{ material.price }} руб.</td>
              <td>{{ material.setupNumber }}</td>
              <td>{{ material.setupNumber * material.price }} руб.</td>
            </tr>
          </tbody>
        </table>

        <div class="row justify-content-end">
          <div class="col-auto">
            <h5>Итого сумма вашего заказа составляет {{ sum }} руб.</h5>
            <hr />
            <br />
          </div>
        </div>

        <Order :products="selectedMaterials" :type="'material'"></Order>
      </div>

      <div
        v-if="selectedMaterials.length === 0"
        class="text-center bg-warning bg-opacity-50 rounded"
      >
        <h5>Выберите материалы для композиции, чтоб произвести заказ.</h5>
      </div>
    </div>

    <div v-show="tab === 'constructor'" id="constructor" class="row p-3 justify-content-center">
      <div class="m-2 rounded shadow col-auto" style="background: #f2eded; min-width: 200px">
        <h4 class="m-2 mx-3">Фильтр</h4>

        <!--фильтр по категориям-->
        <ul class="list-unstyled mb-0 py-3 pt-md-1">
          <CategoryFilter
            v-for="(category, index) in categories"
            :key="index"
            :category="category"
            @update="updateSelectedCategories"
          ></CategoryFilter>
        </ul>
      </div>

      <!--карточки товаров-->
      <div class="col-7">
        <div class="row row-cols-1 row-cols-md-3 g-4 m-0 justify-content-center">
          <Card
            v-for="(material, index) in materials"
            :key="index"
            :index="index"
            :material="material"
            @updateSetupNumber="updateSetupNumber"
          ></Card>

          <!--спинер загрузки товаров-->
          <div class="text-center" v-if="loading">
            <div class="spinner-border" style="width: 5rem; height: 5rem" role="status">
              <span class="sr-only">Загрузка...</span>
            </div>
          </div>
          <button type="button" class="btn btn-warning" @click="tab = 'order'">
            Перейти к оформлению заказа
          </button>
        </div>
      </div>
      <div class="col-auto text-center">
        <canvas id="canvas" :height="canvasHeight" :width="canvasWidth"></canvas>
        <br />
        <h5>Сумма {{ sum }} руб.</h5>
        <button type="button" class="btn btn-warning" @click="resetAll()">
          Сбросить выбранное
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Order from "../components/Order";
import Card from "../components/MaterialCard";
import CategoryFilter from "../components/CategoryFilter";
import axios from "axios";

export default {
  name: "ConstructorView",
  data() {
    return {
      loading: true,
      selectedCategories: [],
      categories: [],
      materials: [],
      selectedMaterials: [],
      /* 
            currentPage: 0,
            lastPage: 1, */
      canvasWidth: 250,
      canvasHeight: 300,
      x: 30,
      y: 140,
      tab: "constructor", //order,
    };
  },
  computed: {
    sum() {
      let sum = 0;
      this.selectedMaterials.forEach((mat) => (sum += mat.setupNumber * mat.price));
      return sum;
    },
  },
  //TOdo: post запрос с добавлением данного заказа
  //todo: selectedMaterials
  methods: {
    //добавляем свойство отвечающее за кол-во материалов, которое выбрал пользователь
    //Добавляется setupNumber к materials[index] при изменении
    resetSetupNumber() {
      this.materials.forEach((material) => {
        material.setupNumber = 0;
      });
      this.selectedMaterials = [];
    },
    resetCanvas() {
      var canvas = document.querySelector("canvas");
      var ctx = canvas.getContext("2d");
      this.x = 30;
      this.y = 140;
      ctx.clearRect(0, 0, this.canvasWidth, this.canvasHeight);
      this.updateCanvas("/../../assets/shelf.png", 0, 50, 250, 200);
    },
    resetAll() {
      this.resetSetupNumber();
      this.resetCanvas();
    },
    updateCanvas(path, x, y, width, height) {
      var canvas = document.querySelector("canvas");
      var ctx = canvas.getContext("2d");

      var img = new Image();
      img.src = path;
      img.onload = () => {
        ctx.drawImage(img, x, y, width, height); // drawImage(img, x, y);
      };
    },
    updateSetupNumber(obj) {
      this.updateCanvas(this.materials[obj.materialIndex].image.path, this.x, this.y, 30, 40);
      if (this.x < this.canvasWidth - 90) {
        this.x += 30;
      } else {
        this.y -= 40;
        this.x = 30;
      }
      if (!this.selectedMaterials.includes(this.materials[obj.materialIndex])) {
        this.selectedMaterials.push(this.materials[obj.materialIndex]);
      }
      this.materials[obj.materialIndex].setupNumber = obj.setupNumber;
    },
    updateSelectedCategories(obj) {
      if (obj.checked) {
        this.selectedCategories.push(obj.id);
      } else {
        this.selectedCategories = this.selectedCategories.filter((id) => id !== obj.id);
      }
      this.getMaterialByCategory();
    },
    getMaterialByCategory() {
      this.materials = [];
      this.loading = true;
      let url = "/api/material";
      for (let i in this.selectedCategories) {
        if (i < 1) {
          url += "?categories[]=" + this.selectedCategories[i];
        } else {
          url += "&categories[]=" + this.selectedCategories[i];
        }
      }
      axios
        .get(url)
        .then((response) => {
          this.materials = response.data.data;
          this.resetSetupNumber();
          this.updateSetupNumber({ setupNumber: 1, materialIndex: 0 });
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        })
        .finally(() => (this.loading = false));
    },
    getCategories() {
      axios
        .get("/api/category")
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        })
        .finally(() => (this.loading = false));
    },
  },
  components: {
    Card,
    CategoryFilter,
    Order,
  },
  mounted() {
    this.getMaterialByCategory();
    this.getCategories();
    this.updateCanvas("/../../assets/shelf.png", 0, 50, 250, 200);
  },
};
</script>
