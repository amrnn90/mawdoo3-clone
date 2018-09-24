import Barba from 'barba.js';
import History from './history';


const history = new History();

window.history.scrollRestoration = 'auto';

Barba.Pjax.goTo = function (url) {
    history.goTo(url);
    this.onStateChange();
};




// function getScrollPosition() {
//     var doc = document.documentElement;
//     var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
//     var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

//     return top;
// }


var HideShowTransition = Barba.BaseTransition.extend({
    start: function () {
        this.newContainerLoading.then(this.finish.bind(this));
    },

    finish: function () {
        setTimeout(() => {
            if (history.    direction() == 'back') {
                window.scrollTo(null, history.get('scrollY'));
            } else {
                window.scrollTo(null, 0);
            }
        });
        this.done();
    }
});


Barba.Pjax.getTransition = function () {
    // store scroll position to previous state
    // to make it accessible in the transition
    // and react to it if necessary
    history.setPrev('scrollY', window.scrollY);

    if (history.direction() === 'forward') {
        return HideShowTransition;
    } else {
        return HideShowTransition;
    }
};


export default {
    register: (callbacks = []) => {
        const page = Barba.BaseView.extend({
            namespace: 'page',
            onEnter: function() {
                callbacks.forEach(c => c.onEnter && c.onEnter());
            },
            onEnterCompleted: function() {
                callbacks.forEach(c => c.onEnterCompleted && c.onEnterCompleted());
            },
            onLeave: function() {
                callbacks.forEach(c => c.onLeave && c.onLeave());
            },
            onLeaveCompleted: function() {
                callbacks.forEach(c => c.onLeaveCompleted && c.onLeaveCompleted());
            },

        });

        page.init();
    },
    start: function() {
        Barba.Pjax.start();
    }
}