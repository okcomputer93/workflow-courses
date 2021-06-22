<template>
    <section class="w-full bg-gray-100 pb-20 h-full flex items-stretch md:pb-0">

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
    name: "Account.vue",
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
            return this.navBarMinimized ? 'md:w-1/12' : 'md:w-1/6';
        }
    },
    methods: {
        changeWidth(value) {
            this.navBarMinimized = value;
        },
        informationState(value) {
            this.informationChanged = value;
        },
        preventLoseData(event) {
            if (!this.$refs.currentView?.pendingInfo) return
            event.preventDefault()
            // Chrome requires returnValue to be set.
            event.returnValue = ""
            this.informationChanged = false;
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
    },
    beforeMount() {
        window.addEventListener("beforeunload", event => {
            this.preventLoseData(event);
        })
    },
    beforeDestroy() {
        window.removeEventListener("beforeunload", this.preventLoseData);
    },
}
</script>

<style scoped>

</style>
