import Vue from 'vue';
import CommentsSection from "./components/comments/CommentsSection";
import AddComment from "./components/comments/AddComment";
import VModal from 'vue-js-modal';

Vue.use(VModal);

require('./bootstrap');

Vue.component('comments-section', CommentsSection);
Vue.component('add-comment', AddComment);

const app = new Vue({
    el: '#app'
});
