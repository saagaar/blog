/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import fontawesome from '@fortawesome/fontawesome-free/js/all.js';
fontawesome.config = { autoReplaceSvg: false }
require('./bootstrap');

window.Vue = require('vue');
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);
// Vue.use(window.Vuelidate.default)
import helpers from './helpers/global';
Vue.use({
    install() {
        Vue.helpers = helpers;
        Vue.prototype.$helpers = helpers;
    }
});

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

// Vue.component('top-nav', require('./components/TopNav/TheTopNav.vue').default);
// Vue.component('main-nav', require('./components/MainNav/TheMainNav.vue').default);
// Vue.component('footer', require('./components/Footer/Footer.vue').default);

// Vue.component('Home', require('./components/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(require('vue-moment'));

// import Gate from './services/Gate.js';
// Vue.prototype.$gate = new Gate();
// import config from './config/config.js';

// import TheTopNav from './components/TopNav/TheTopNav';
// Vue.component('TheTopNav', require('./components/TopNav/TheTopNav.vue'));
// import TheMainNav from './components/MainNav/TheMainNav';
// Vue.component('TheMainNav', require('./components/MainNav/TheMainNav.vue'));
import Contact from './components/LandingPage/Contact';
import Favorite from './components/Favorites/Favorite';
import FbShare from './components/Share/FbShare';
import TwShare from './components/Share/TwShare';
import TheFooter from './components/Footer/TheFooter';
import SuccessErrorMessage from './components/SuccessErrorMessage.vue';
import ListComment from './components/Comment/ListComment';
import AddComment from './components/Comment/AddComment';
import Comment from './components/Comment/Comment';
import IconCommentsCount from './components/Comment/IconCommentsCount';
import Likes from './components/Likes/Likes';
import SaveBlog from './components/Likes/SaveBlog';
import LikeCheck from './components/Likes/LikeCheck';
import BlogLoading from './components/InfiniteLoading/BlogLoading';
import BlogLoadingBySlug from './components/InfiniteLoading/BlogLoadingBySlug';
import LatestBlogLoading from './components/InfiniteLoading/LatestBlogLoading';
import Gate from './services/Gate.js';
import LoginButton from './components/TopNav/LoginButton';
import SignUpButton from './components/TopNav/SignUpButton';
import TheLoginSignupModal from './components/TopNav/TheLoginSignupModal';
import NotificationsLoading  from './components/InfiniteLoading/NotificationsLoading';
import Newsletter from './components/LandingPage/Newsletter';
import UserSubscribe from './components/LandingPage/UserSubscribe';
import CategorySubscribe from './components/LandingPage/CategorySubscribe';
// import UserDashboard from './pages/UserDashboard';
const default_layout="default";
const app = new Vue({
    el: '#app',
    data(){
        // config:config
    },
    store,
    beforeCreate() 
    {
       
       if(window.__USER_STATE__!==undefined)
       {
            let userState = JSON.parse(window.__USER_STATE__) || {};
            this.$store.commit('ADD_ME', userState)
            Vue.prototype.$gate = new Gate(userState);
       }
    },
    components:{
            // 'the-top-nav':TheTopNav,
            'contact':Contact,
            'fb-share':FbShare,
            'tw-share':TwShare,
            'the-footer':TheFooter,
            'list-comment':ListComment,
            'add-comment':AddComment,
            'comment':Comment,
            'likes':Likes,
            'like-check':LikeCheck,
            'icon-comments-count':IconCommentsCount,
            'blog-loading':BlogLoading,
            'blog-slug-loading':BlogLoadingBySlug,
            'latest-blog-loading':LatestBlogLoading,
            'login-button':LoginButton,
            'signup-button':SignUpButton,
            'the-login-signup-modal':TheLoginSignupModal,
            'notification-loading':NotificationsLoading,
            'success-error-message':SuccessErrorMessage,
            'favorite':Favorite,
            'newsletter':Newsletter,
            'save-blog':SaveBlog,
            'user-subscribe':UserSubscribe,
            'category-subscribe':CategorySubscribe
          
        }
    

});
