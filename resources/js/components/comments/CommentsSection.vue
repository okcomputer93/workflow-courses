<template>
    <div class="w-full flex flex-col justify-between items-center py-20">
        <h2 class="text-2xl font-bold">{{ `Todos los comentarios (${comments.length})` }}</h2>
        <comments-list class="mt-10" :comments="showedComments"></comments-list>
        <button class="mt-5 px-4 shadow-md rounded-md bg-indigo-500 hover:bg-indigo-700 inline-block text-white text-sm px-8 rounded-full py-3 transition-colors duration-300"
                @click="showMore()"
                v-if="thereIsComments"
        >
            Mostrar Más
        </button>
    </div>
</template>

<script>
import axios from 'axios';
import CommentsList from "./CommentsList";
export default {
    name: "CommentsSection",
    props: ['course'],
    components: {
        CommentsList
    },
    data() {
        return {
            comments: [],
            shown: 3,
        }
    },
    computed: {
        showedComments() {
            return this.comments.reduce((acc, comment, index) => {
                if (index < this.shown) {
                   acc.push(comment);
                }
                return acc;
            }, [])
        },
        thereIsComments() {
            return this.comments.length > this.showedComments.length;
        }
    },
    methods: {
        showMore() {
            if (this.thereIsComments) {
                this.shown += 3;
            }
        }
    },
    async mounted() {
        const response = await axios.get(`/api/courses/${this.course}/comments`);
        this.comments = response.data;
    }
}
</script>

<style scoped>

</style>
