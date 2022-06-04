<template>
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
        <button type="button" class="btn btn-warning" @click="recaptcha">Произвести заказ</button>
    </div>
</template>

<script>

export default {
    name: "OrderComponent",
    props: ['products', 'type'],
    data() {
        return {
            phoneNumber: "111111",
            address: "dddddddddd",
            nameSurname: "sssssssssssss",
            date: '2022-05-31 17:14',
            description: "aaaaaaaaaaaaasdfasdfasdfasdf",
            email: "aaaaaaaa",
        }
    },
    methods: {
        recaptcha() {
            this.$recaptchaLoaded().then(() => {
                this.$recaptcha('login').then(token => {
                    this.postOrder(token)
                })
            })
        },
        postOrder(token) {
            axios.post('/api/order/' + this.type, {
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
                    console.log(response)
                    if (response.data != null) {
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
    }
};
</script>