<template>
    <article class="bg-white rounded-sm rounded-md border border-gray-200 transition-shadow duration-300 z-10 overflow-hidden course-card w-60 h-96 xl:h-64 xl:w-full">
        <div class="flex items-center h-full w-full flex-col xl:flex-row">
            <img class="w-32 h-32 shadow-lg bg-gray-200 hover:shadow-xl transition-shadow duration-300 xl:w-44 xl:h-44"
                 :src="`/${course.miniature}`"
                 :alt="`${course.title}' s miniature`"
            >
            <div class="flex flex-col justify-between h-full w-full items-center p-6 xl:items-start">
                <div class="flex flex-wrap justify-between items-center space-x-2">
                    <p :class="`flex-shrink-0 text-xs font-light p-1 border border-category-${course.category.id} text-category-${course.category.id} rounded-lg xl:font-bold xl:uppercase`"
                    >
                        {{ course.category.name | format }}
                    </p>
                    <p :class="`flex-shrink-0 text-xs font-light p-1 border border-level-${course.level.id} text-level-${course.level.id} rounded-lg xl:font-bold xl:uppercase`"
                    >
                        {{ course.level.name | format }}
                    </p>
                </div>
                <h2 class="text-base text-center font-bold xl:text-2xl xl:text-left">{{ course.title | shortener }}</h2>
                <p class="text-xs text-gray-500">{{ course.owner.name }}</p>
                <div class="xl:self-end">
                    <a :href="coursePath" target="_blank" rel="noopener noreferrer"
                              class="text-center text-xs px-4 rounded-full py-2 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 xl:px-8 xl:py-3"
                    >
                        Detalles
                    </a>
                </div>
            </div>
        </div>
    </article>

</template>

<script>
export default {
    name: "CourseCard.vue",
    props: {
        course: Object
    },
    computed: {
      coursePath() {
          return `/courses/${this.course.slug}`
      }
    },
    filters: {
        format(value) {
            if (!value) return;
            value = value.toString();
            return value.replaceAll('_', '' )
                .replace(/\b[a-z]/g, (letter) => letter.toUpperCase());
        },
        shortener(value) {
            const MAX_STRING = 40;
            return value.length > MAX_STRING ? value.substr(0, MAX_STRING) + '...' : value;
        }
    }
}
</script>

<style scoped>

</style>
