import Loader from './Loader';

export default {
    onEnter: function() {
        // The new Container is ready and attached to the DOM.
    },
    onEnterCompleted: function() {
        // The Transition has just finished.
        new Loader({
            containerEl: document.querySelector('.posts-grid'),
            items: '.posts-grid__item',
            more: 'li.active + li > a',
            buttonEl: document.querySelector('.load-more'),
        });
    },
    onLeave: function() {
        // A new Transition toward a new page has just started.
    },
    onLeaveCompleted: function() {
        // The Container has just been removed from the DOM.
    }
};