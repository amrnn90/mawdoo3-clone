import Swup from 'swup';

const swup = new Swup({
    LINK_SELECTOR: 'a[href^="' + window.location.origin + '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup]):not(.toc-link)',
    doScrollingRightAway: true,
    animateScroll: true,
    scrollFriction: .3,
    scrollAcceleration: .04,
    elements: ['#swup-main', '#swup-header']
    // scroll: false
});

let callbacks = [];


document.addEventListener('swup:willReplaceContent', event => {
    callbacks.forEach(c => c.onLeave && c.onLeave());
});

// document.addEventListener('swup:pageLoaded', event => {
//     console.log('pageView');
//     callbacks.forEach(c => c.onEnter && c.onEnter());
// });

document.addEventListener('swup:contentReplaced', event => {
    callbacks.forEach(c => c.onEnter && c.onEnter());
});


export default {
    register: (_callbacks = []) => {
        callbacks = _callbacks;

        callbacks.forEach(c => c.onEnter && c.onEnter());
    }
}