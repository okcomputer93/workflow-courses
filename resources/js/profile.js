import Vue from 'vue';
import VModal from 'vue-js-modal';
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VModal);

require('./bootstrap');

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
