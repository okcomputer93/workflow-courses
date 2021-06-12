<template>
    <aside class="bg-white shadow-md rounded-r-md fixed left-0 top-0 h-screen transition-width duration-1000 p-6"
           :class="asideWidth"
    >
        <nav class="flex flex-col justify-between items-center h-full">
            <div class="flex flex-col justify-start items-start space-y-6 w-full">
                <button @click="minimize"
                        type="button"
                        class="self-end text-gray-400 hover:text-gray-500 cursor-pointer focus:outline-black"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6 transform transition-transform duration-500"
                         :class="arrowOrientation"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="relative self-center w-full h-12 mt-8 mb-2">
                    <a href="/courses" class="focus:outline-black">
                        <transition name="wait-fade-main">
                            <img v-show="!isMinimized" class="absolute h-10 w-auto top-0 right-1/2 transform translate-x-1/2" src="/images/workflow-logo-inverse.svg" alt="Workflow Logo">
                        </transition>
                        <transition name="wait-out">
                            <img v-show="isMinimized" class="absolute h-10 w-auto top-0 right-1/2 transform translate-x-1/2" src="/images/workflow-mark.svg" alt="Workflow Logo">
                        </transition>
                    </a>
                </div>

                <navigation-link title="Dashboard"
                                 :is-minimized="isMinimized"
                                 link="/user/dashboard"
                >
                    <template v-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </template>
                </navigation-link>

                <navigation-link title="Mi Perfil"
                                 :is-minimized="isMinimized"
                                 link="/user/profile"
                >
                    <template v-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </template>
                </navigation-link>
            </div>

            <logout></logout>
        </nav>
    </aside>
</template>

<script>
import NavigationLink from "./NavigationLink";
import Logout from "./Logout";
export default {
    name: "NavigationBar.vue",
    components: {
        NavigationLink,
        Logout
    },
    data() {
        return {
            isMinimized: false,
        }
    },
    computed: {
      asideWidth() {
          return this.isMinimized ? 'w-28' : 'w-1/6';
      },
      arrowOrientation() {
          return this.isMinimized ? '-rotate-180' : ''
      }
    },
    methods: {
        minimize() {
            this.isMinimized = !this.isMinimized;
            this.$emit('minimize', this.isMinimized);
            localStorage.setItem('workflow-navbar-minimized', this.isMinimized);
        }
    },
    created() {
        const minimized = localStorage.getItem('workflow-navbar-minimized');
        if (minimized) {
            this.isMinimized = minimized === "true";
        }
        this.$emit('minimize', this.isMinimized);
    }
}
</script>

<style scoped>
.wait-out-leave-active {
    transition: opacity 1s ease-in;
}

.wait-fade-main-enter,
.wait-out-leave-to {
    opacity: 0;
}
.wait-fade-main-enter-active {
    transition: opacity 0.4s ease-in 0.8s;
}
</style>
