<template>
    <div class="h-52 grid auto-rows-min auto-cols-auto w-full md:grid-cols-4 md:auto-rows-auto md:grid-cols-4 w-full">
        <div class="row-span-1 justify-self-start place-self-end md:place-self-start md:col-span-1 md:justify-self-center">
            <img class="rounded-full h-16 w-16"
                 :src="`/${comment.author.avatar}`"
                 :alt="`${comment.author.name}'s avatar`">
        </div>
        <div class="row-span-1 border border-gray-300 p-8 rounded-lg bg-white md:col-span-3">
            <h3 class="font-bold text-xl">{{ comment.author.name }}</h3>
            <span class="text-xs text-gray-400" >{{ comment.created_at | toDate }}</span>
            <rating :max="5" :value="comment.rate" :read-only="true"></rating>
            <p class="text-sm font-gray-400 mt-2 break-words">{{ comment.content }}</p>
        </div>
    </div>
</template>

<script>
import Rating from "./Rating";
export default {
    name: "CommentCard",
    components: {
        Rating
    },
    props: ['comment'],
    filters: {
        toDate(val) {
            return new Date(val).toISOString().replace(/T/, ' a las ').replace(/\..+/, '')
        }
    }
}
</script>

<style scoped>

</style>
