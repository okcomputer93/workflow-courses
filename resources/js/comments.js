import Vue from 'vue';
import CommentsSection from "./components/comments/CommentsSection";

require('./bootstrap');

Vue.component('comments-section', CommentsSection);

const app = new Vue({
    el: '#app'
});
