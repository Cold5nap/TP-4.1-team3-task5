<template>
    <div class="card rounded m-2 shadow col p-0" style="width: 9rem; overflow: hidden;">
        <img class="card-img " :src="material.image.path" :alt="material.image.name" style="cursor: pointer;"
            @click="updateParentSetupNumber(material.setupNumber + 1)">
        <div class="card-body p-1">
            <div class="row justify-content-between">
                <h5 class="col-auto">
                    {{ material.name }}
                </h5>
                <div class="col-auto">
                    <b class="card-text">{{ material.price }} руб.</b>
                </div>
            </div>
            Количество {{material.setupNumber}}
        </div>
    </div>
</template>

<script>
export default {
    name: "MaterialCard",
    props: ['material', 'index'],
    methods: {
        updateParentSetupNumber(val) {
            if (val <= this.material.number) {
                this.$emit('updateSetupNumber', { setupNumber: val, materialIndex: this.index });
            }
        }
    },
}
</script>
