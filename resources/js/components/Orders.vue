<template>
    <div class="container ">
        <h3 class="m-4 text-center">Заказы</h3>
        <div v-if="orders.length > 0">
            <div v-for="(order, index) in orders" :key="index">
                <h5>Заказ №{{ index }}</h5>
                <p>Дата доставки {{order.date}}</p>
                <p>Адрес доставки{{order.address}}</p>
                <p>Имя, отчество {{order.name_surname}}</p>
                <p>Номер телефона{{order.phone_number}}</p>
                <p>email {{order.email}}</p>
                <p>Статус оплаты {{order.is_paid?'оплачен':'не оплачен'}}</p>
                <p>Статус выполнения заказ {{order.status}}</p>
                <table class="table  table-hover" v-if="order.products.length > 0">
                    <thead>
                        <tr>
                            <th scope="col">Товар</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in order.products" :key="product.id">
                            <th scope="row"><img :src="product.mainImage.path" :alt="product.mainImage.name" class="img"
                                    style="height: 70px; width: 70px;">
                            </th>
                            <td class="align-middle">
                                <h5>{{ product.name }}</h5>
                            </td>
                            <td class="align-middle">{{ product.price }} руб.</td>
                            <td class="align-middle">{{ product.numberProducts }}</td>
                            <td class="align-middle">{{ product.price * product.numberProducts }} руб.</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-hover" v-if="order.materials.length > 0">
                    <thead>
                        <tr>
                            <th scope="col">Товар</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="material in order.materials" :key="material.id">
                            <th scope="row"><img :src="material.image.path" :alt="material.image.name" class="img"
                                    style="height: 70px; width: 70px;">
                            </th>
                            <td class="align-middle">
                                <h5>{{ material.name }}</h5>
                            </td>
                            <td class="align-middle">{{ material.price }} руб.</td>
                            <td class="align-middle">{{ material.numberMaterials }}</td>
                            <td class="align-middle">{{ material.price * material.numberMaterials }} руб.</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div v-if="orders.length == 0 && !loading" class="bg-black bg-opacity-10 p-3 text-center rounded">
                <h5>Ваш список заказов пуст.</h5>
            </div>

            <div class="text-center" v-if="loading">
                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Загрузка...</span>
                </div>
            </div>
        </div>
        <div v-else class="row justify-content-center">
            <div class="col-auto" v-if="!canEnterCode">
                <label class="form-control-label" for="email">Введите email</label>
                <input type="text" class="form-control" id="email" v-model="email" placeholder="email@mail.ru">
                <button type="button" class="btn btn-warning" @click="requestCode">Получить код подтверждения</button>
            </div>
            <div v-else class="col-auto">
                <span class="m-3">Указанная почта {{email}}.</span>
                <label class="form-control-label" for="code">Введите полученный на указанную почту код</label>
                <input type="text" class="form-control" id="code" v-model="code">
                <button type="button" class="btn btn-warning" @click="getOrderByCode">Отправить код
                    подтверждения</button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "OrdersComponent",
    data() {
        return {
            orders: [],
            loading: true,
            email: 'cold4nap@gmail.com',
            canEnterCode: false,
            code: 'pujvnJazHi',
        }
    },
    methods: {
        requestCode() {
            let url = '/api/order/code';
            axios.post(url, {
                email: this.email
            }, { headers: { 'Content-Type': 'application/json' } })
                .then(response => {
                    if (response.status == 204) {
                        this.canEnterCode=true
                        alert('Код подтверждения отправлен на почту.')
                    } else {
                        alert(response.data)
                    }
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
        },
        getOrderByCode() {
            this.loading = true
            let url = '/api/order';
            axios.post(url, {
                    code: this.code,
                    email:this.email,
            }, { headers: { 'Content-Type': 'application/json' } })
                .then(response => {
                    console.log(response)
                    this.orders = response.data.data
                    console.log(this.orders);
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
    },
    mounted() {
    }
};
</script>