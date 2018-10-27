
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./load-more-posts');
require('./header');


const swup = require('./swup').default;

$(function() {
    swup.register([
        require('./vue').default,
        require('./toc').default,
        require('./addthis').default,
        require('./filepond').default,
        require('./tinymce').default,
        require('./parsley').default,
        require('./select2').default,
        // require('./tables').default,
    ]);
});


