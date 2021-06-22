<template>
    <div class="fixed"
         :class="positionClass"
    >
        <button
            class="bg-indigo-500 z-50 p-4 text-white flex justify-between items-center rounded-full hover:bg-indigo-600 transition-all duration-300 focus:outline-black transform hover:-translate-y-0.5 md:p-6"
            @click="$emit('click')"
        >
            <slot></slot>
        </button>
    </div>
</template>

<script>
export default {
    name: "FloatingButton",
    emits: ['click'],
    props: {
        position: String,
    },
    computed: {
        positionClass() {
            const padding = 6
            const mobilePadding = 1;
            const positions = this.position.split('-');
            return `${positions[0]}-${mobilePadding} md:${positions[0]}-${padding} ${positions[1]}-${mobilePadding} md:${positions[1]}-${padding}`
        }
    }
}
</script>

<style scoped>

</style>
