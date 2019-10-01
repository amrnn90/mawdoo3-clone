const Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));


export default {
    onEnter: () => {    
        window.app = new Vue({
            el: '#app', 
        });
    },
    onLeave: () => {
        if (window.app && window.app.$destroy) {
            window.app.$destroy();
        }
    }
}


