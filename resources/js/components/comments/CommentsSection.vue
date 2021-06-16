<template>
   <div>
       <div class="w-full h-96 bg-white flex flex-col justify-center items-center"
            v-if="isLoading"
       >
           <h4 v-if="!errors">Cargando Comentarios</h4>
           <h3 class="text-base font-bold text-red-400" v-else>{{ errors }}</h3>
           <loading-spinner></loading-spinner>
       </div>
       <div class="w-full flex flex-col bg-white justify-between items-center py-20"
            v-else
       >
           <h2 class="text-3xl font-bold">{{ `Todos los comentarios (${comments.length})` }}</h2>
           <span class="h-1 w-1/12 bg-indigo-500 my-1"></span>
           <comments-list class="mt-10" :comments="showedComments"></comments-list>
           <button class="mt-5 px-4 shadow-md rounded-md bg-indigo-500 hover:bg-indigo-700 inline-block text-white text-sm px-8 rounded-full py-3 transition-colors duration-300 focus:outline-black"
                   @click="showMore()"
                   v-if="thereIsComments"
           >
               Mostrar Más
           </button>
       </div>
   </div>
</template>

<script>
import axios from 'axios';
import CommentsList from "./CommentsList";
import Rating from "./Rating";
import LoadingSpinner from '../core/LoadingSpinner';
export default {
    name: "CommentsSection",
    props: ['course'],
    components: {
        CommentsList,
        Rating,
        LoadingSpinner
    },
    data() {
        return {
            comments: [],
            shown: 3,
            isLoading: false,
            errors: '',
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
        try {
            this.isLoading = true;
            const response = await axios.get(`/api/courses/${this.course}/comments`);
            this.comments = response.data;
            this.isLoading = false;
        } catch (e) {
            this.errors =  'No se pudieron cargar los comentarios.'
        }
    }
}
</script>

<style scoped>

</style>
