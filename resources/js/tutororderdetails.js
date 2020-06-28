window._ = require('lodash');
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

require('./jquery-ui');

window.moment = require('moment');

window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '8979ccbf537975ba5c02',
    cluster: 'ap3',
    encrypted: true
});
import store from './store'
Vue.config.productionTip = false
//Vue.use(Antd)
Vue.component('tutor-order-view', require('./components/tutor/order.vue').default);
const app = new Vue({
    el: '#tutor-order-view',
    store
});
