<template>
    <div>
        <h1>Here are some comments</h1>
        <div>{{ course }}</div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "CommentsSection",
    props: ['course'],
    async mounted() {
        const response = await axios.get(`/api/courses/${this.course}/comments`);
        console.log(response.data);
    }
}
</script>

<style scoped>

</style>
