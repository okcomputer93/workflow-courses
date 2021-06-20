<template>
    <div class="px-1 pt-10 w-full md:pl-20 sm:p-5 md:pr-30 md:py-14">
        <div class="md:pl-5">
            <slot name="title"></slot>
        </div>
        <div class="flex flex-col justify-center items-center md:items-start md:justify-between md:flex-row">
            <div class="flex-1 md:p-5">
              <slot name="left"></slot>
            </div>
            <div v-if="rightSlotExists" class="flex-1 p-2 mt-2 md:p-5">
              <slot name="right"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AccountSection.vue",
    computed: {
        rightSlotExists() {
            return this.$slots.right;
        }
    }
}
</script>

<style scoped>

</style>
