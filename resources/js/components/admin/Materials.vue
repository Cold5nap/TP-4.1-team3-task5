<template>
    <div class="">
        <div class="row m-3">
            <h3>Добавление материала </h3>
            <button @click="showAddForm" class="btn btn-sm">Показать/Скрыть</button>
            <form @submit.prevent='storeMaterial' class="row" v-show="isStoreForm">
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="name">Введите название</label>
                        <input type="text" v-model="name" placeholder="Название" id="name" class="form-control">
                    </div>
                    <div class="col-3 form-group">
                        <label for="price">Цена материала(1шт.)</label>
                        <input type="text" v-model="price" placeholder="цена" id="price" class="form-control">
                    </div>
                    <div class="col-4 form-group">
                        <label for="number">Введите кол-во материалов</label>
                        <input type="number" v-model="number" placeholder="кол-во" id="number" class="form-control">
                    </div>
                    <div class="col-3 form-group">
                        <label for="sum">Сумма за материалы</label>
                        <input disabled type="text" placeholder="Сумма за материалы" id="sum"
                            v-bind:value="number*price" class="form-control">
                    </div>

                    <div class="col-3 form-group">
                        <label for="image">Выберите изображение</label>
                        <input type="file" class="form-control form-control-file" ref="image" @change="uploadImage"
                            id="image">
                    </div>

                    <div class="col-3 form-group">
                        <label>Выберите категории</label>
                        <select multiple class="form-control form-select" v-model="selectCategories">
                            <option v-for="category in categories" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-success">Добавить композицию</button>
            </form>

        </div>
        <hr>


        <div class=" m-3" id="materials">
            <h3>Материалы</h3>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Категории</th>
                        <th scope="col">Изображение</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="material in materials">
                        <td>{{ material.name }}</td>
                        <td>{{ material.price }}</td>
                        <td>{{ material.number }}</td>
                        <td>{{ material.price * material.number }}</td>
                        <td><span v-for="category in material.categories">{{ category.name }}<br></span></td>
                        <td><img height="70" v-bind:src="material.image.path" v-bind:alt="material.image.name"></td>
                        <td>
                            <form @submit.prevent="deleteMaterial(material.id)">
                                <button class='btn btn-sm btn-danger' type="submit"><i class="bi bi-x-lg"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center" v-if="loading">
                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Загрузка...</span>
                </div>
            </div>

            <paginate v-model="currentPage" :page-count="lastPage" :click-handler="goToPage" :prev-text="'Предыдущая'"
                :next-text="'Следующая'" :container-class="'pagination'" :page-class="'page-item'"
                :page-link-class="'page-link'" :prev-link-class="'page-link'" :next-link-class="'page-link'">
            </paginate>

        </div>
    </div>
</template>

<script>
import Paginate from 'vuejs-paginate-next';
export default {
    data() {
        return {
            //отображение материалов
            materials: [],
            loading: true,
            //пагинация
            lastPage: 0,
            currentPage: 0,

            //форма добавления
            selectCategories: [2, 3],
            image: null,
            name: 'test',
            price: 100,
            number: 3,
            isStoreForm: false,
            categories: [],
        }
    },
    methods: {
        goToPage(pageNum) {
            this.getMaterials(pageNum)
        },
        setPagination(response) {
            this.currentPage = response.data.meta.current_page;
            this.lastPage = response.data.meta.last_page;
        },
        showAddForm() {
            if (!this.categories.length > 0) {
                this.getCategories()
            }
            this.isStoreForm = !this.isStoreForm;
        },
        uploadImage() {
            this.image = this.$refs.image.files[0];
        },
        storeMaterial() {
            this.materials = []
            this.loading = true;
            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('name', this.name);
            formData.append('number', this.number);
            formData.append('price', this.price);
            for (let key in this.selectCategories) {
                formData.append('categories_id[]', this.selectCategories[key]);
            }
            axios.post('/api/adm/materials', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.getMaterials()
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        deleteMaterial(id) {
            this.materials = [];
            this.loading = true;
            axios.post('/api/adm/materials/' + id, {
                _method: 'DELETE'
            })
                .then(response => {
                    this.getMaterials()
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        getMaterials(pageNumber) {
            this.materials = []
            this.loading = true
            axios.get('/api/adm/materials?page=' + pageNumber)
                .then(response => {
                    this.setPagination(response)
                    this.materials = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        getCategories() {
            axios.get('/api/adm/categories')
                .then(response => {
                    this.categories = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
    },
    mounted() {
        this.getMaterials(1)
    }, 
    components: {
        Paginate
    }

}
</script>

<style scoped>
</style>
