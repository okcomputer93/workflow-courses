<template>
    <section class="w-full bg-gray-100 h-full flex items-stretch">

        <div class="transition-width duration-1000"
             :class="navBarWidth"
        >
            <nav-bar @minimize="changeWidth"></nav-bar>
        </div>

        <div class="flex-1">
            <router-view></router-view>
        </div>
    </section>
</template>

<script>
import NavBar from "./NavBar";
export default {
    name: "Settings.vue",
    components: {
        NavBar
    },
    data() {
        return {
            navBarMinimized: null,
        }
    },
    computed: {
        navBarWidth() {
            return this.navBarMinimized ? 'w-1/12' : 'w-1/6';
        }
    },
    methods: {
        changeWidth(value) {
            this.navBarMinimized = value;
        }
    }
}
</script>

<style scoped>

</style>
