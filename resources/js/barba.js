import Barba from 'barba.js';
import History from './history';


const history = new History();

window.history.scrollRestoration = 'auto';

Barba.Pjax.goTo = function (url) {
    history.goTo(url);
    this.onStateChange();
};

Barba.Dispatcher.on('transitionCompleted', function () {
    if (window.app && window.Vue) {
        window.app.$destroy();
        window.app = new window.Vue({ el: '#app' });
    }


});

Barba.Pjax.start();


function getScrollPosition() {
    var doc = document.documentElement;
    var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
    var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

    return top;
}


var HideShowTransition = Barba.BaseTransition.extend({
    start: function () {
        this.newContainerLoading.then(this.finish.bind(this));
    },

    finish: function () {
        if (history.direction() == 'back') {
            setTimeout(() => {
                window.scrollTo(null, history.get('scrollY'));
            });
        }
        this.done();
    }
});


Barba.Pjax.getTransition = function () {
    // store scroll position to previous state
    // to make it accessible in the transition
    // and react to it if necessary
    history.setPrev('scrollY', window.scrollY);

    // console.log(history.direction());

    if (history.direction() === 'forward') {
        return HideShowTransition;
    } else {
        return HideShowTransition;
    }
};