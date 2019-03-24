
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../semantic/dist/semantic.min');
require('../../node_modules/swupjs/dist/swupjs.min');
require('../../node_modules/semantic-ui-calendar/dist/calendar.min');
import './jquery.mCustomScrollbar.concat.min';
import './jquery.serialize-object.min';
import Swupjs from 'swup';
import Toasted from 'vue-toasted';

window.bcrypt = require('bcryptjs');
window.Vue = require('vue');

let options = {
    animations: {
        '*': {
            in: function(next){
                document.querySelector('#swup').style.opacity = 0;
                TweenLite.to(document.querySelector('#swup'), .5, {
                    opacity: 1,
                    onComplete: next
                });
            },
            out: function(next){
                document.querySelector('#swup').style.opacity = 1;
                TweenLite.to(document.querySelector('#swup'), .5, {
                    opacity: 0,
                    onComplete: next
                });
            }
        },
    }
}

const swupjs = new Swupjs(options);

Vue.component('login', require('./components/Login.vue').default);
Vue.component('caas-component', require('./components/Caas-component.vue').default);
Vue.component('calendar-component', require('./components/Calendar-component.vue').default);

Vue.use(require('vue-moment'));   
Vue.use(Toasted, {
    iconPack : 'material', // set your iconPack, defaults to material. material|fontawesome|custom-class
    theme: 'bubble',
    position: 'top-center',
});

const app = new Vue({
    el: '#app'
});

Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
