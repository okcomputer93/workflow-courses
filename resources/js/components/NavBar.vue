<template>
    <aside class="bg-white shadow-md rounded-r-md fixed left-0 top-0 h-screen transition-width duration-1000 p-6"
           :class="asideWidth"
    >
        <nav class="flex flex-col justify-start items-start space-y-6">
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

            <div class="w-full">
                <router-link class="block p-4 hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer rounded-lg focus:outline-black"
                             to="/user/dashboard"
                             active-class="is-dashboard-active"
                             exact
                >
                    <div class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>

                        <transition name="wait-fade">
                            <span v-if="!isMinimized" class="pl-3 text-sm">Dashboard</span>
                        </transition>
                    </div>
                </router-link>
            </div>

            <div class="w-full">
                <router-link class="block p-4 hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer rounded-lg focus:outline-black"
                             to="/user/profile"
                             active-class="is-dashboard-active"
                >
                    <div class="flex justify-center items-center ">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>

                        <transition name="wait-fade">
                            <span v-if="!isMinimized" class="pl-3 text-sm">Mi Perfil</span>
                        </transition>
                    </div>

                </router-link>
            </div>

        </nav>
    </aside>
</template>

<script>
export default {
    name: "NavBar.vue",
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
    watch: {
      isMinimized(value) {
          this.$emit('minimize', value);
      }
    },
    methods: {
        minimize() {
            this.isMinimized = !this.isMinimized;
            localStorage.setItem('workflow-navbar-minimized', this.isMinimized);
        }
    },
    created() {
        const minimized = localStorage.getItem('workflow-navbar-minimized');
        if (minimized) {
            this.isMinimized = minimized === "true";
        }

    }
}
</script>

<style scoped>
.wait-fade-enter-active {
    transition: opacity 0.4s ease-in 1s;
}

.wait-out-leave-active {
    transition: opacity 1s ease-in;
}

.wait-fade-enter,
.wait-fade-main-enter,
.wait-out-leave-to {
    opacity: 0;
}

.wait-fade-main-enter-active {
    transition: opacity 0.4s ease-in 0.8s;
}

</style>
