<template>
<div class="d-flex justify-content-center">
    <div class="border rounded shadow m-3 p-3">
        <h4>Категории</h4><br>
        <div id="categories">
            <div class="d-flex justify-content-center" v-if="loading">
                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Загрузка...</span>
                </div>
            </div>
        </div>
    </div>

    <div class=" border rounded shadow m-3 p-3">
        <h4>Добавление категории</h4>
        <div class="form-group">
            <label for="name">Введите название</label>
            <input type="text" name="name" placeholder="Название" id="name" class="form-control" v-model="name">
        </div>

        <label class="form-label">Родительская категория</label>
        <select id="parent" class='form-control form-select' v-model="parent_id">
            <option value="0" selected>Нет родительской категории</option>
            <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
        </select>
        <br>
        <button v-on:click="storeCategory()" class="btn btn-success">Добавить</button>
    </div>
</div>


</template>

<script>
export default {
    data() {
        return {
            categories: [],
            loading: true,
            errored: false,
            name:null,
            parent_id:0,
        }
    },
    methods: {
        childCategories(children,categories,ul) {
            if (children.length > 0) {
                let childrenUl = document.createElement('ul');
                for (let key in children) {
                    let li = document.createElement('li');
                    li.appendChild(document.createTextNode(children[key].name));

                    let i = document.createElement('a');
                    i.className='bi bi-trash3';
                    i.onclick = ()=>{
                        this.deleteCategory(children[key].id);
                    }
                    li.appendChild(i);

                    childrenUl.appendChild(li);

                    this.childCategories(categories.filter(category => category.parent_id === children[key].id),categories,childrenUl);
                }
                ul.appendChild(childrenUl);
            }
        },
        category(categories) {
            let ul = document.createElement('ul');
            let parents = categories.filter(category => category.parent_id === 0);
            for (let key in parents) {
                let li = document.createElement('li');
                li.appendChild(document.createTextNode(parents[key].name));

                let i = document.createElement('a');
                i.className='bi bi-trash3';
                i.onclick = ()=>{
                    this.deleteCategory(parents[key].id);
                }
                li.appendChild(i);
                ul.appendChild(li);

                this.childCategories(categories.filter(category => category.parent_id === parents[key].id),categories,ul);
            }

            let categoriesEl = document.getElementById('categories');
            categoriesEl.innerHTML='';
            categoriesEl.appendChild(ul);
        },
        deleteCategory(id){
            axios.post('/api/categories/'+id,{
                _method:'DELETE'
            })
                .then(response => {
                    this.categories = []
                    this.getCategories()
                    this.category(this.categories)
                })
                .catch(error=>{
                    console.log(error)
                    this.errored=true
                })
                .finally(()=>this.loading = false)
        },
        storeCategory(){
            axios.post('/api/categories',{
                name:this.name,
                parent_id:this.parent_id,
            })
                .then(() => {
                    this.categories = []
                    this.getCategories()
                    this.category(this.categories)
                })
                .catch(error=>{
                    console.log(error)
                    this.errored=true
                })
                .finally(()=>this.loading = false)
        },
        getCategories(){
            axios.get('/api/categories')
                .then(response => {
                    this.category(response.data.data)
                    this.categories = response.data.data
                })
                .catch(error=>{
                    console.log(error)
                    this.errored=true
                })
                .finally(()=>this.loading = false)
        }
    },
    mounted() {
        this.getCategories()
    }
}
</script>
