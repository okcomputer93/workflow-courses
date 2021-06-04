<template>
    <div>
        <div v-for="course in courses" class="pt-10">
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
