/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue').default;
import Config from './config';


import Echo from "laravel-echo";
window.io = require('socket.io-client');
window.socket = io(Config.host + ':' + Config.port);
window.eventApp = new Vue();

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: Config.host + ':' + Config.port
});
  /**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

 Vue.component('notifications', require('./components/Notifications.vue').default);
 Vue.component('index-notifications', require('./components/IndexNotifications.vue').default);
 Vue.component('clients-search', require('./components/ClientsSearch.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
