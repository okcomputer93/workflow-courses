<template>
    <div>
        <div v-if="isLoading"
             class="w-full h-screen flex justify-center items-center"
        >
            <loading-spinner></loading-spinner>
        </div>
        <transition name="fade">
            <dashboard-section v-if="!isLoading">
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
                    <div class="w-full relative">
                        <div class="bg-gray-200 absolute w-full h-full top-0 transform -rotate-3 rounded-lg z-10"></div>
                        <div class="bg-white rounded-lg shadow-lg z-20 relative">
                            <div class="flex flex-col justify-center items-center py-5">
                                <h2 class="text-xl font-bold text-gray-600">Algunas recomiendaciones para tí</h2>
                                <h3 class="text-sm font-bold text-gray-400">Cursos creados recientemente</h3>
                                <courses-list :courses="courses"></courses-list>
                            </div>
                        </div>
                    </div>
                </template>
            </dashboard-section>
        </transition>
    </div>
</template>


<script>
import axios from 'axios';
import CoursesList from "./CoursesList";
import DashboardSection from "./DashboardSection";
import LoadingSpinner from "./LoadingSpinner";
export default {
    name: 'Dashboard',
    components: {
        CoursesList,
        DashboardSection,
        LoadingSpinner
    },
    data() {
      return {
          user: {},
          courses: [],
          isLoading: null,
          loadingError: '',
      }
    },
    async created() {
       try {
           this.isLoading = true;
           const userResponse = await axios.get('/api/user/information');
           this.user = userResponse.data;

           const coursesResponse = await axios.get('/api/courses/last');
           this.courses = coursesResponse.data;
       } catch (e) {
           this.loadingError = e.toString();
       } finally {
           this.isLoading = false;
       }
    }
}
</script>

<style scoped>
.fade-enter-active {
    transition: all 1.5s ease-in-out;
}
.fade-enter {
    opacity: 0;
    transform: scale(1.1);
}
</style>
