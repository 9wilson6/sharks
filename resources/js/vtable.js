window.axios = require('axios');
window._ = require('lodash');
import Vue from 'vue'
import VueEvents from 'vue-events'

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
Vue.component('all-orders', require('./components/tables/orders/index.vue').default);
Vue.component('all-tutors', require('./components/tables/tutors/index.vue').default);
Vue.component('all-students', require('./components/tables/student/index.vue').default);
import {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    VuetablePaginationDropDown
} from 'vuetable-2'
Vue.component("vuetable", Vuetable);
Vue.component("vuetable-pagination", VuetablePagination);
Vue.component("vuetable-pagination-dropdown", VuetablePaginationDropDown);
Vue.component("vuetable-pagination-info", VuetablePaginationInfo);
Vue.use(VueEvents)
window.onload = function () {
    const tableVue = new Vue({
        el: '#tableVue'
    })
}