<template>
    <section class="w-full bg-gray-100 h-full flex items-stretch">

        <div class="transition-width duration-1000"
             :class="navBarWidth"
        >
            <nav-bar @minimize="changeWidth"></nav-bar>
        </div>

        <div class="flex-1">
            <router-view @information-changed="informationState"></router-view>
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
            informationChanged: false,
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
        },
        informationState(value) {
            this.informationChanged = value;
        }
    },
    beforeRouteUpdate(to, from, next) {
        if (this.informationChanged) {
            const answer = confirm('Hay cambios sin guardar, ¿deseas abandonar?');
            if(!answer) {
                return false;
            }
        }
        this.informationChanged = false;
        return next();
    }
}
</script>

<style scoped>

</style>
