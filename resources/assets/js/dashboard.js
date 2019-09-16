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


Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use( CKEditor );

import store from './store/index'

Vue.component('top-nav', require('./components/TopNav/TopNav.vue').default);

import config from './config/config.js';
import UserDashboard from './components/UserDashboard';
const app = new Vue({
    el: '#dashboard',
    router,
    data(){
        config:config
    },
    store,
    beforeCreate() 
    {
        this.$store.dispatch('checkLoginUser');
    },
    render: function (createElement) 
    {
    	// this.$store.dispatch('checkLoginUser');
    	// if(this.$store.getters.user.isLoggedIn)
	  	    return createElement(UserDashboard);
	},

});
