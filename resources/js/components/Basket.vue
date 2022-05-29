<template>
  <div class="container">
    <h3 class="mb-4">Ваша корзина</h3>
    <table class="table text-muted table-hover">
      <thead>
        <tr>
          <th scope="col">Товар</th>
          <th scope="col">Наименование товара</th>
          <th scope="col">Цена</th>
          <th scope="col">Количество</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><img src="/images/лимониум.png" alt="..." class="img" style="height: 70px; width: 70px;"></th>
          <td class="align-middle">Лимониум морской синий</td>
          <td class="align-middle">700 р.</td>
          <td class="align-middle"><input type="number" class="form-control" value="1"
              style="width: 60px; height: 40px;"></td>
          <td> <i class="bi bi-x-lg" style="color: #3E3C3C"></i></td>
          <td class="align-middle">
            <i class="bi bi-x-lg" style="width: 20px; height: 20px"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "BasketComponent",
  getProductById(pageNumber = 1) {
    this.products = []
    this.loading = true
    let url = '/api/product' + pageNumber;
    axios.get(url)
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
};
</script>