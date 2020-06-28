
window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Antd from 'ant-design-vue'
import VeeValidate from 'vee-validate'
import store from './store'
Vue.config.productionTip = false
Vue.use(Antd)
Vue.use(VeeValidate, {
    inject: false
})
Vue.component('order-form-home', require('./components/orderform/home/calculator.vue').default);
const app = new Vue({
    el: '#calculatorhome',
    $_veeValidate: {
        validator: 'new'
    },
    store
});