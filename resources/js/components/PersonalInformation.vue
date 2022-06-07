<template >
    

        <div class="container">

            <h2 class="mt-5 mt-5 ">Профиль</h2>

            <div class="accordion accordion-flush mt-5 mb-5" id="accordionPanelsStayOpenExample">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne" style="background: #FFE55D; color: #3E3C3C">
                            <h4>Личные данные</h4>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <div class="card-body">
                                <h2 class="card-title">Дрюкова Полина</h2>
                                <div class="row mt-5">
                                    <div class="col">
                                        <label for="email" class="text-muted">Email</label>
                                        <p class="text" id="email">dpv1202@mail.ru</p>
                                    </div>
                                    <div class="col">
                                        <label for="phone" class="text-muted">Телефон</label>
                                        <p class="text" id="phone">+7 (951) 851 2723</p>
                                    </div>
                                    <div class="col">
                                        <label for="city" class="text-muted">Адрес доставки</label>
                                        <p class="text" id="city">г. Воронеж, ул.Цветочная, 5</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo" style="background: #FFE55D; color: #3E3C3C">
                                <h4>Заказы</h4>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">

                            <div class="accordion-body">
                                <table class="table text-muted table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Товар</th>
                                            <th scope="col">Наименование товара</th>
                                            <th scope="col">Цена</th>
                                            <th scope="col">Количество</th>
                                            <th scope="col">Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><img src="/images/image6.png" alt="..." class="img"></th>
                                            <td class="align-middle">Лимониум морской синий</td>
                                            <td class="align-middle">700 р.</td>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Ожидайте звонка менеджера</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</template>

<script>
export default {

}
</script>