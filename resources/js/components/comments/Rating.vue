<template>
    <div class="py-2 flex flex-row-reverse justify-end items-center">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-6 w-6 text-gray-500 cursor-pointer"
             fill="currentColor"
             viewBox="0 0 24 24"
             v-for="(starClass, index) in starsClasses"
             :class="`${starClass} ${readOnlyClass}`"
        >
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
    </div>
</template>

<script>
export default {
    name: "Rating",
    props: ['rate', 'readOnly'],
    data() {
        return {
            maxRating: 5,
        }
    },
    computed: {
        starsClasses() {
            return Array(this.maxRating)
                .fill('')
                .map((_, index) => {
                    if (index <= this.rate - 1) return 'text-yellow-400';
                    return '';
                })
                .reverse();
        },
        readOnlyClass() {
            if (!this.readOnly) {
                return 'star';
            }
        }
    }
}
</script>

<style scoped>
.star:hover,
.star:hover ~ .star {
    color: #fbbf24;
    transition: color 0.3s ease-in;
}

</style>
