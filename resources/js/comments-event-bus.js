import Vue from 'vue';

class CommentsEventBus {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null) {
        return this.vue.$emit(event, data);
    }

    listen(event, callback) {
        return this.vue.$on(event, callback);
    }
}

export default  new CommentsEventBus();
