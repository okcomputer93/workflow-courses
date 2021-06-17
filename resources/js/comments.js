import Vue from 'vue';
import VModal from 'vue-js-modal';
import CommentsSection from "./components/comments/CommentsSection";
import AddComment from "./components/comments/AddComment";
import ScrollTo from "./components/core/ScrollTo";

Vue.use(VModal);

require('./bootstrap');

Vue.component('comments-section', CommentsSection);
Vue.component('add-comment', AddComment);
Vue.component('scroll-to', ScrollTo);

const app = new Vue({
    el: '#app'
});
