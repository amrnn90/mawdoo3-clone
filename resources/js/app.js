
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// const barba = require('./barba').default;
const swup = require('./swup').default;

$(function() {
    swup.register([
        require('./vue').default,
        require('./load-more-posts').default,
        require('./toc').default,
        require('./addthis').default
    ]);
});


