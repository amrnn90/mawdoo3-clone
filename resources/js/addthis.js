export default {
    onEnter: function() {
        // The new Container is ready and attached to the DOM.
        if (window.addthis && window.addthis.layers && window.addthis.layers.refresh) {
            addthis.layers.refresh();
        }
    },
    onEnterCompleted: function() {
        // The Transition has just finished.

    },
    onLeave: function() {
        // A new Transition toward a new page has just started.
    },
    onLeaveCompleted: function() {
        // The Container has just been removed from the DOM.
    }
};