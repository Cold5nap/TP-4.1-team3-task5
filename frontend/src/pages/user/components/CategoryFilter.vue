<template>
  <li class="mx-3 m-1">
    <a
      class="text-decoration-none text-black d-inline-flex align-items-center rounded collapsed"
      style="cursor: pointer"
      data-bs-toggle="collapse"
      :data-bs-target="'#cat-id' + category.id"
      aria-expanded="false"
      @click="isCollapsed = !isCollapsed"
    >
      <i class="bi bi-caret-right" v-if="isCollapsed"></i>
      <i class="bi bi-caret-down" v-if="!isCollapsed"></i>
      {{ category.name }}
    </a>

    <div class="collapse" :id="'cat-id' + category.id">
      <ul class="list-unstyled small">
        <li class="m-2 mx-3" v-for="subcategory in category.child_categories" :key="subcategory.id">
          <input
            class="form-check-input"
            type="checkbox"
            :value="subcategory.id"
            autocomplete="off"
            @change="$emit('update', { checked: $event.target.checked, id: $event.target.value })"
            :id="'checkbox-id' + subcategory.id"
          />
          <label :for="'checkbox-id' + subcategory.id">{{ subcategory.name }}</label
          ><br />
        </li>
      </ul>
    </div>
  </li>
</template>

<script>
export default {
  name: "CategoryFilterComponent",
  props: ["category"],
  data() {
    return {
      isCollapsed: true,
    };
  },
};
</script>
