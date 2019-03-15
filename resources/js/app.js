
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./main');
require('../../node_modules/semantic-ui/dist/semantic.min')
import VueRouter from 'vue-router';
import './jquery.mCustomScrollbar.concat.min';

window.Vue = require('vue');
Vue.use(VueRouter);

let routes = [
    { path: '/', component: require('./components/Practicant.vue').default },
    { path: '/admin', component: require('./components/Admin.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.component('login', require('./components/Login.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('button-counter', {
    data: function () {
      return {
        count: 0
      }
    },
    template: '<button v-on:click="count++">You clicked me {{ count }} times.</button>'
})

const app = new Vue({
    el: '#app'
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
