<template>
    <div class="">

        <div class="row m-3">
            <h3>Добавление товара </h3>
            <button @click="showAddForm" class="btn btn-sm">Показать/Скрыть</button>
            <div v-show="isStoreForm">
                <div class="text-center" v-if="loadingForm">
                    <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                        <span class="sr-only">Загрузка...</span>
                    </div>
                </div>
                <form @submit.prevent="" v-show="!loadingForm">
                    <div class="row">
                        <div class="col-3 form-group rounded border m-2   ">
                            <label class="text-black" for="name">Введите название</label>
                            <input type="text" v-model="name" placeholder="Название" id="name"
                                   class="form-control">
                        </div>
                        <div class="col form-group rounded border m-2  ">
                            <label class="text-black" for="cost_price">Себестоимость</label>
                            <input disabled type="text" v-bind="costPrice" id="cost_price" class="form-control"
                                   value="">
                            <!--                    Сделать с js высчитывание себестоимости композиции-->
                        </div>
                        <div class="col form-group rounded border m-2  ">
                            <label class="text-black" for="markup">Введите наценку %</label>
                            <input type="number" min="0" v-model="markup" placeholder="Наценка в процентах"
                                   id="markup"
                                   class="form-control">
                        </div>
                        <div class="col-2 form-group rounded border m-2  ">
                            <label class="text-black" for="price">Цена композиции</label>
                            <input type="text" v-model="price" placeholder="цена" id="price"
                                   class="form-control">
                        </div>
                        <div class="col-3 form-group rounded border m-2  ">
                            <label class="text-black" for="count_goods">Введите кол-во композиций</label>
                            <input type="number" min="1" v-model="number" placeholder="кол-во" id="count_goods"
                                   class="form-control">
                        </div>
                        <div class="col-2 form-group rounded border m-2  ">
                            <label class="text-black" for="sum">Сумма за композиции</label>
                            <input disabled type="text" v-bind:value="sum" id="sum" class="form-control"
                                   value="">
                        </div>
                        <div class="col-1 form-group rounded border m-2  ">
                            <label class="text-black" for="discount">Скидка</label>
                            <input type="text" v-model="discount" id="discount" class="form-control">
                        </div>

                        <div class="col-3 form-group rounded border m-2  ">
                            <label class="text-black" for="main_image">Выберите главное изображение</label>
                            <input type="file" class="form-control form-control-file text-black" ref="mainImage"
                                   id="main_image" @change="uploadMainImage">
                        </div>

                        <div class="col-3 form-group rounded border m-2  ">
                            <label class="text-black" for="images">Выберите остальные изображения</label>
                            <input type="file" multiple class="form-control form-control-file text-black"
                                   ref="images" id="images" @change="uploadImages">
                        </div>

                        <div class="col-4 form-group border m-2 rounded">
                            <b>Материалы</b>
                            <div class="row">
                                <b class="col">Страница</b>
                                <b class="col">Материал</b>
                                <b class="col">Количество</b>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control col" @change="getMaterials($event.target.value)">
                                        <option v-for='page in materialPages' :value="page">{{ page }}
                                        </option>
                                    </select>
                                </div>
                                <select class="form-control col" v-model="selectMaterial">
                                    <option v-for='material in materials' :value="material">{{ material.name }}
                                    </option>
                                </select>
                                <div class="col">
                                    <input class="form-control" type="number" min="0"
                                           v-model="numberSelectMaterial">
                                </div>

                                <button class=" btn-sm btn-success"
                                        @click="addMaterial">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <div v-if='selectMaterials.length>0' class=""><b>Использованные материалы</b></div>
                            <div v-for="(row,index) in selectMaterials" class="row">
                                <div class="col">
                                    <p>{{ row[0].name }}</p>
                                </div>
                                <div class="col">
                                    <p>{{ row[1] }}</p>
                                </div>

                                <button type="button" class='btn btn-sm btn-danger'
                                        @click="selectMaterials.splice(index,1)">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>


                        <div class="col-4 form-group border m-2   rounded">
                            <label class="text-black" for="categories_id">Выберите категорию</label>
                            <select multiple class="form-control form-select" v-model="selectCategories"
                                    id="categories_id">
                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <div class="col-1 form-group rounded border m-2  ">
                            <label class="text-black" for="height">Высота</label>
                            <input type="number" v-model="height" id="height" class="form-control">
                            <label class="text-black" for="width">Ширина</label>
                            <input type="number" v-model="width" id="width" class="form-control">
                        </div>

                        <div class="col-9 form-group rounded border m-2 ">
                            <label class="text-black" for="description">Описание</label>
                            <textarea rows="9" cols="100" v-model="description" placeholder="Описание товара"
                                      id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" @click='storeProduct'
                            class="container-fluid mt-2 btn btn-lg btn-success">Добавить композицию
                    </button>
                </form>
            </div>

        </div>
        <hr>


        <!--Отображение продуктов-->
        <div class=" m-3" id="products">
            <h3>Продукты</h3>
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Себестоимость</th>
                    <th scope="col">Наценка</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Скидка</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Высота/Ширина</th>
                    <th scope="col">Состав</th>
                    <th scope="col">Категории</th>
                    <th scope="col">Изображение</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="product in products">
                    <td>{{ product.name }}</td>
                    <td>{{ Math.round(product.price * 100 / (100 + product.markup)) }}</td>
                    <td>{{ product.markup }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.number }}</td>
                    <td>{{ product.discount }}</td>
                    <td>{{ product.price * product.number }}</td>
                    <td>{{ product.size.height }}/{{ product.size.width }}</td>
                    <td><span v-for="material in product.composition">{{ material.name }}<br></span></td>
                    <td><span v-for="category in product.categories">{{ category.name }}<br></span></td>
                    <td><img height="70" v-bind:src="product.mainImage.path"
                             v-bind:alt="product.mainImage.name"></td>
                    <td>
                        <form @submit.prevent="deleteProduct(product.id)">
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

            <paginate
                v-model="currentPageProduct"
                :page-count="lastPageProduct"
                :click-handler="getProducts"
                :prev-text="'Предыдущая'"
                :next-text="'Следующая'"
                :container-class="'pagination'"
                :page-class="'page-item'"
                :page-link-class="'page-link'"
                :prev-link-class="'page-link'"
                :next-link-class="'page-link'"
            >
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
            products: [],
            loading: true,
            //пагинация
            lastPageProduct: 0,
            currentPageProduct: 0,

            //форма добавления
            loadingForm: true,
            materialPages: [],
            materials: [],
            selectMaterial: null,
            numberSelectMaterial: 1,
            selectPage: null,
            sum: null,
            costPrice: null,
            isStoreForm: false,
            categories: [],

            //отправляется на сервер с формы
            name: 'test',
            markup: 10,
            price: 100,
            number: 3,
            discount: 5,
            mainImage: null,
            images: [],
            selectMaterials: [],
            selectCategories: [2, 3],
            height: 30,
            width: 40,
            description: "Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum",
        }
    },
    methods: {
        setPaginationMaterials(response) {
            this.selectMaterial = null;
            this.materialPages = []
            for (let i = 1; i <= response.data.meta.last_page; i++) {
                this.materialPages.push(i)
            }
        },
        getMaterials(pageNumber = 1) {
            this.loadingForm = true;
            axios.get('/api/adm/materials?page=' + pageNumber)
                .then(response => {
                    this.setPaginationMaterials(response)
                    this.materials = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loadingForm = false)
        },
        uploadImages() {
            this.images = this.$refs.images.files;
        },
        addMaterial() {
            if (this.selectMaterial != null) {
                this.selectMaterials.push([this.selectMaterial, this.numberSelectMaterial])
            }
        },
        setPaginationProduct(response) {
            this.currentPageProduct = response.data.meta.current_page;
            this.lastPageProduct = response.data.meta.last_page;
        },
        showAddForm() {
            if (this.categories.length <= 0 && this.materials <= 0) {
                this.getCategories()
                this.getMaterials()
            }

            this.isStoreForm = !this.isStoreForm;
        },
        uploadMainImage() {
            this.mainImage = this.$refs.mainImage.files[0];
        },
        storeProduct() {
            this.products = []
            this.loading = true;

            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('markup', this.markup);
            formData.append('price', this.price);
            formData.append('number', this.number);
            formData.append('discount', this.discount);
            formData.append('main_image', this.mainImage);
            for(let key in this.images){
                formData.append('images[]', this.images[key]);
            }
            for (let key in this.selectMaterials){
                formData.append('materials_id[]', this.selectMaterials[key][0].id);
                formData.append('number_materials_id[]', this.selectMaterials[key][1]);
            }
            for (let key in this.selectCategories){
                formData.append('categories_id[]', this.selectCategories[key]);
            }
            formData.append('height', this.height);
            formData.append('width', this.width);
            formData.append('description', this.description);

            axios.post('/api/adm/products', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(() => {
                    this.getProducts()
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        deleteProduct(id) {
            this.products = [];
            this.loading = true;
            axios.post('/api/adm/products/' + id, {
                _method: 'DELETE'
            })
                .then(() => {
                    this.getProducts()
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        getProducts(pageNumber = 1) {
            this.products = []
            this.loading = true
            axios.get('/api/adm/products?page=' + pageNumber)
                .then(response => {
                    this.setPaginationProduct(response)
                    this.products = response.data.data
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
        this.getProducts()
    },
    components:{
        Paginate
    }

}
</script>
