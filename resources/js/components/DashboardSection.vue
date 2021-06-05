<template>
    <div class="px-20 py-8">
        <div class="flex justify-between">
            <div class="flex-1 p-5">
              <slot name="left"></slot>
            </div>
            <div v-if="rightSlotExists" class="flex-1 p-5 mt-2">
              <slot name="right"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DashboardSection.vue",
    computed: {
        rightSlotExists() {
            return this.$slots.right;
        }
    }
}
</script>

<style scoped>

</style>
