window.Vue = require('vue')
import VueRouter from 'vue-router'
window.axios = require('axios');
import { router } from './router'
Vue.use(VueRouter)
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
Vue.component('add-funds', require('./components/addfunds/add.vue').default);
const addfunds = new Vue({
    el: '#add-funds',
    router
});