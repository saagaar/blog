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
Vue.use(VueRouter);
Vue.use(Vuelidate);
// Vue.use(window.Vuelidate.default)

import store from './store/index'

/**
Custom Imports goes here
*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('top-nav', require('./components/TopNav/TopNav.vue').default);
// Vue.component('Home', require('./components/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Home from './components/Home';
import UserDashboard from './components/UserDashboard';
const app = new Vue({
    el: '#app',
    router,
    store,
    beforeCreate() {
            this.$store.dispatch('checkLoginUser');
        },

    render: function (createElement) {
    	 // this.$store.dispatch('checkLoginUser');
    	if( this.$store.getters.user.isLoggedIn)
	  	return createElement(UserDashboard);
		else
	 	 return createElement(Home);
	},

});
