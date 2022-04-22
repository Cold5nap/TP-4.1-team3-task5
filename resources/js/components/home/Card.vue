<template>

  <div class="card rounded m-2 shadow col p-0" style="width: 14rem;overflow: hidden">
    <router-link class="text-decoration-none text-black card-link" :to="{name:'show'}">

      <img class="card-img "
           src="/images/1_20-04-2022_19-29-30_mist-trres-river-forest-moss-fall-long-exposure-landscape-na — копия — копия.webp"
           alt="Card image cap">

      <div class="card-img-overlay p-0 h-25">
        <div class="row">
          <div class="col text-start">
            <small class=" badge rounded-pill bg-danger ">Скидка 50%</small>
          </div>
          <div class="col text-end">
            <small class="badge bg-black opacity-75 rounded">
              50см
              <i class="bi bi-arrow-left-right"></i>
            </small>
            <br>
            <small class="bottom badge bg-black opacity-75 rounded">50см
              <i class="bi bi-arrow-down-up"></i>
            </small>
          </div>
        </div>
      </div>
    </router-link>

    <div class="card-body p-1">
      <router-link class="text-decoration-none text-black card-link" :to="{name:'show'}"><h5 class="text-center">Название
        карточки</h5></router-link>
      <div class="row">
        <span class="col mx-2 text-start text-muted card-text text-decoration-line-through">700 р.</span>
        <b class="col mx-2 text-end card-text ">700 р.</b>
      </div>
      <div class="d-flex mt-1">

        <i class="bi bi-heart h2 mx-2" style="cursor: pointer"></i>
        <button type="submit" class="btn btn-warning text-dark container-fluid mx-2"> В
          корзину
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card"
}
</script>

<style scoped>

</style>
