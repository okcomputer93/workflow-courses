<template>
    <div class="space-y-5 mt-5 max-w-lg flex flex-col items-end">
        <div v-for="course in courses">
            <course-card :course="course" :key="course.id"></course-card>
        </div>
    </div>
</template>

<script>
import CourseCard from "./CourseCard";
export default {
    name: "CoursesList.vue",
    props: ['courses'],
    components: {
        CourseCard
    }
}
</script>

<style scoped>

</style>
