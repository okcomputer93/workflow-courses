<template>
    <article class="bg-white rounded-sm shadow-lg rounded-md hover:shadow-xl transition-shadow duration-300 z-10 overflow-hidden course-card" style="width: 32rem;">
        <div class="flex items-center">
            <img class="w-44 h-44 shadow-lg bg-gray-200 hover:shadow-xl transition-shadow duration-300"
                 :src="course.miniature"
                 :alt="`${course.title}' s miniature`"
            >
            <div class="flex flex-col justify-between items-start h-48 w-full p-6">
                <div class="flex flex-wrap justify-between items-center space-x-2">
                    <p :class="`flex-shrink-0 text-xs font-bold uppercase p-1 border border-category-${course.category.id} text-category-${course.category.id} rounded-lg`"
                    >
                        {{ course.category.name | format }}
                    </p>
                    <p :class="`flex-shrink-0 text-xs font-bold uppercase p-1 border border-level-${course.level.id} text-level-${course.level.id} rounded-lg`"
                    >
                        {{ course.level.name | format }}
                    </p>
                </div>
                <h2 class="text-2xl font-bold">{{ course.title | shortener }}</h2>
                <p class="text-xs text-gray-500">{{ course.owner.name }}</p>
                <div class="self-end">
                    <a :href="coursePath" target="_blank" rel="noopener noreferrer"
                              class="text-center text-xs px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300"
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
    props: ['course'],
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
