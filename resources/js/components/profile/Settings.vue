<template>
    <section class="w-full bg-gray-100 h-full flex items-stretch">

        <div class="transition-width duration-1000"
             :class="navBarWidth"
        >
            <navigation-bar @minimize="changeWidth"></navigation-bar>
        </div>

        <div class="flex-1">
            <router-view ref="currentView"></router-view>
        </div>
    </section>
</template>

<script>
import NavigationBar from "./NavigationBar";
export default {
    name: "Settings.vue",
    components: {
        NavigationBar
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
        if (this.$refs.currentView?.pendingInfo) {
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
