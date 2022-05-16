/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import { ValidationObserver, ValidationProvider, extend} from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';

import Toaster from 'v-toaster'
import Vue from 'vue'

import 'v-toaster/dist/v-toaster.css'

Vue.use(Toaster, {timeout:4000})


extend('email', email);

extend('required', {
    ...required,
    message: 'This field is required'
});

Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('welcome-component', require('./components/WelcomeComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);
//dashboard
Vue.component('dashboard-component', require('./components/dashboard/DashboardComponent.vue').default);
Vue.component('sidebar-component', require('./components/dashboard/SidebarComponent.vue').default);
Vue.component('header-component', require('./components/dashboard/HeaderComponent.vue').default);
Vue.component('courses-component', require('./components/dashboard/CoursesComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
