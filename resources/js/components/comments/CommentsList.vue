<template>
   <div class="mt-5 w-auto md:w-2/5 md:mt-10">
       <transition-group name="fade">
           <div class="py-12 w-full md:py-6"
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
    props: ['comments'],
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
