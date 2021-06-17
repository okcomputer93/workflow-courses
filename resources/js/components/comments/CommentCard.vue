<template>
    <div class="h-44 grid grid-cols-4 auto-rows-auto" style="width: 640px;">
        <div class="col-span-1 justify-self-center">
            <img class="rounded-full h-16 w-16"
                 :src="`/${comment.author.avatar}`"
                 :alt="`${comment.author.name}'s avatar`">
        </div>
        <div class="col-span-3 border border-gray-300 p-8 rounded-lg bg-white">
            <h3 class="font-bold text-xl">{{ comment.author.name }}</h3>
            <span class="text-xs text-gray-400" >{{ comment.created_at | toDate }}</span>
            <rating :max="5" :value="comment.rate" :read-only="true"></rating>
            <p class="text-sm font-gray-400 mt-2 break-all">{{ comment.content }}</p>
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
