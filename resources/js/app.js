
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./main');
require('../../semantic/dist/semantic.min');
require('../../node_modules/swupjs/dist/swupjs.min');
import './jquery.mCustomScrollbar.concat.min';
import Swupjs from 'swup';

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

const app = new Vue({
    el: '#app'
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
