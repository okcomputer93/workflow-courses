<template>
    <dashboard-section>
        <template v-slot:title>
            <h1 class="text-5xl font-bold text-gray-800">
                Hola de nuevo,
                <span class="text-indigo-500">{{ user.name }}</span>
            </h1>
        </template>
        <template v-slot:left>
            <p class="text-xl font-light text-gray-600 pt-4">Parece un buen día para aprender algo nuevo.</p>
            <img class="mt-4 h-auto w-full" src="/images/learning-person.svg" alt="Illustration learning person">
        </template>
        <template v-slot:right>
               <h2 class="text-xl font-bold text-gray-600">Algunas recomiendaciones para tí</h2>
               <h3 class="text-sm font-bold text-gray-400">Cursos creados recientemente</h3>
               <courses-list :courses="courses"></courses-list>
        </template>
    </dashboard-section>
</template>


<script>
import axios from 'axios';
import CoursesList from "./CoursesList";
import DashboardSection from "./DashboardSection";
export default {
    name: 'Dashboard',
    components: {
        CoursesList,
        DashboardSection
    },
    data() {
      return {
          user: {},
          courses: [],
      }
    },
    async created() {
        const userResponse = await axios.get('/api/user/information');
        this.user = userResponse.data;

        const coursesResponse = await axios.get('/api/courses/last');
        this.courses = coursesResponse.data;
    }
}
</script>
