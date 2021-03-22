require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from "vue-router";
import routes from "./routes.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    mode: "history"
});

const app = new Vue({
    el: '#app',
    router
});