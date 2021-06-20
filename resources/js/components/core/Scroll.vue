<template>
    <transition name="pop-up">
        <floating-button position="right-bottom"
                         v-if="isVisible"
                         @click="top()"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
            >
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 10l7-7m0 0l7 7m-7-7v18"
                />
            </svg>

        </floating-button>
    </transition>
</template>

<script>
import FloatingButton from "./FloatingButton";
export default {
    name: "ScrollTo",
    props: {
        to: String
    },
    components: {
        FloatingButton
    },
    data() {
        return {
            isVisible: false,
        }
    },
    methods: {
        top() {
            window.scroll({
                top: 0,
                behavior: 'smooth',
            })
        }
    },
    mounted() {
        const section = document.getElementById(this.to);
        const sectionHeight = section.clientHeight;
        window.addEventListener('scroll', () => {
            this.isVisible = section.getBoundingClientRect().top <= sectionHeight * -1;
        }, { passive: true })
    }
}
</script>

<style scoped>

.pop-up-enter-active,
.pop-up-leave-active {
    transition: all 0.3s ease-out;
}

.pop-up-enter,
.pop-up-leave-to {
    transform: scale(0.5);
    opacity: 0;
}

</style>
