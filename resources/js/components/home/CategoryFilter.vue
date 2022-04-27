<template>
    <li class="mx-3 m-1">
        <a class="text-decoration-none text-black d-inline-flex align-items-center rounded collapsed"
           style="cursor: pointer" data-bs-toggle="collapse" :data-bs-target="'#cat-id'+category.id"
           aria-expanded="false" @click="isCollapsed=!isCollapsed">
            <i class="bi bi-caret-right" v-if="isCollapsed"></i>
            <i class="bi bi-caret-down" v-if="!isCollapsed"></i>
            {{category.name}}
        </a>

        <div class="collapse" :id="'cat-id'+category.id">
            <ul class="list-unstyled small">
                <li class="m-2 mx-3 " v-for="subcategory in category.child_categories">
                    <input  type="checkbox" v-model="checked" :value="subcategory.id" autocomplete="off"
                           @change="onInput1" :id="'checkbox-id'+subcategory.id">
                    <label :for="'checkbox-id'+subcategory.id">{{ subcategory.name }}</label><br>
                </li>
            </ul>
        </div>
    </li>
</template>

<script>
export default {
    name: "CategoryFilter",
    props:['category','value'],
    computed: {
        checked: {
            get() {
                return this.value
            },
            set(val) {
                this.checkedP = val
            }
        }
    },
    methods:{
      onInput1(e){
          this.$emit('input', this.checkedP)
      }
    },
    data() {
        return {
            checkedP: false,
            isCollapsed: true,
        }
    }
}
</script>

<style scoped>

</style>
