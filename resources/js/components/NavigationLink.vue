<template>
    <div class="w-full">
        <router-link class="block p-4 hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer rounded-lg focus:outline-black"
                     :to="link"
                     active-class="is-dashboard-active"
                     exact
        >
            <div class="flex justify-center items-center">
                <slot name="icon"></slot>
                <transition name="wait-fade">
                    <span v-if="!isMinimized" class="pl-3 text-sm">{{ title }}</span>
                </transition>
            </div>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "NavigationLink.vue",
    props: ['isMinimized', 'title', 'link']
}
</script>

<style scoped>
.wait-fade-enter-active {
    transition: opacity 0.4s ease-in 1s;
}

.wait-fade-enter {
    opacity: 0;
}
</style>
