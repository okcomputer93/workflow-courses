<template>
    <div class="space-y-5 mt-5">
        <template v-for="course in courses">
            <course-card :course="course" :key="course.id"></course-card>
        </template>
    </div>
</template>

<script>
import CourseCard from "./CourseCard";
export default {
    name: "CoursesList.vue",
    props: {
        courses: Array
    },
    components: {
        CourseCard
    }
}
</script>

<style scoped>

</style>
