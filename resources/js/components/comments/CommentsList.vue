<template>
   <div class="mt-5 w-auto md:w-3/5 md:mt-10 xl:max-w-3xl">
       <transition-group name="fade">
           <div class="py-2 w-full md:py-6"
                v-for="comment in comments"
                :key="comment.id"
           >
               <comment-card :comment="comment"></comment-card>
           </div>
       </transition-group>
   </div>
</template>

<script>
import CommentCard from "./CommentCard";
export default {
    name: "CommentsList",
    props: {
      comments: Array
    },
    components: {
        CommentCard
    }
}
</script>

<style scoped>
.fade-enter-active {
    transition: opacity 1.5s ease-in-out;
}
.fade-enter {
    opacity: 0;
}
</style>
