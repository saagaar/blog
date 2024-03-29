/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import '@fortawesome/fontawesome-free/js/all.js';
require('./bootstrap');
window.Vue = require('vue');
import Vuelidate from 'vuelidate'
import router from './routes.js'
import VueRouter from 'vue-router';
import CKEditor from '@ckeditor/ckeditor5-vue';

import helpers from './helpers/global';
Vue.use({
    install() {
        Vue.helpers = helpers;
        Vue.prototype.$helpers = helpers;
    }
});

 
Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(require('vue-moment'));
import store from './store/index'
import config from './config/config.js';
Vue.prototype.$config=config;
import UserDashboard from './layouts/UserDashboard';
import Profile from './layouts/Profile';
Vue.component('default-layout',UserDashboard);
Vue.component('timeline-layout', Profile);
import Gate from './services/Gate.js';
Vue.use( CKEditor );

const default_layout="default";
const app = new Vue({
    el: '#dashboard',
    router,
    data(){
        config:config
    },
    store,
    beforeCreate() 
    {
        let userState = JSON.parse(window.__USER_STATE__) || {};
        if (userState) {
           this.$store.commit('ADD_ME', userState)
           Vue.prototype.$gate = new Gate(userState);
        }
        this.$store.dispatch('checkLoginUser');
    },
    render: function (createElement) 
    {
         let layout=(this.$route.meta.layout || default_layout)+'-layout';
	  	 return createElement(layout);
	},
   
});
