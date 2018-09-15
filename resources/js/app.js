
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const Barba = require('barba.js');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example-component', require('./components/ExampleComponent.vue'));

let app = new Vue({
    el: '#app', 
});

Barba.Pjax.start();

Barba.Dispatcher.on('transitionCompleted', function() {
    app.$destroy();
    app = new Vue({ el: '#app' });
});