<template>
    <header class="border-bottom">

        <div class="container header_top p-1  mb-0">
            <nav class="navbar navbar-light bg-ligh">
                <router-link :to="{name:'home'}" class="navbar-brand text-dark text-decoration-none">
                    <span class="navbar-brand">Fiori_VRN</span>
                </router-link>
                <ul class="nav nav-pills">
                <li class="nav-item ">
                    <router-link :to="{name:'constructor'}" class="nav-link text-dark">Конструктор букетов</router-link>
                </li>
                </ul>
                <div class="input-group w-25">
                    <button type="button" class="btn btn-warning">
                        <i class="bi bi-search"></i>

                    </button>
                    <input type="search" class="form-control" placeholder="Поиск по сайту" aria-label="Поиск по сайту"
                           aria-describedby="basic-addon1">
                </div>

                <ul class="nav nav-pills">

                    <li class="nav-item">
                        <a class="text-dark nav-link" href="tel:+73333333">+7 (333) 33-33</a>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'about'}" class="text-dark nav-link">Про нас</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'contact'}" class="text-dark nav-link">Контакты</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'message'}" class="text-dark nav-link">Сообщение</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'user'}" class="text-dark nav-link">
                            <i class="bi bi-person-square h3"></i>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'favorite'}" class="text-dark nav-link">
                            <i class="bi bi-bag-heart h3"></i>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'shopping-cart'}" class="text-dark nav-link">
                            <i class="bi bi-bag h3"></i>
                        </router-link>
                    </li>

                </ul>
            </nav>
        </div>

    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>
