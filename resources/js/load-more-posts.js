import Loader from './Loader';

new Loader([
    {
        container: '.posts-grid',
        // items: '.posts-grid__item',
        paginate: {
            target: 'li.active + li > a',
            noMoreClass: 'no-more-items',
        },
        trigger: '.load-more',
        replace: false,
    },
    {
        container: '.posts-list',
        trigger: '.tabs__tab-link',
        replace: true,
        afterLoad: ({el, url}) => {
            const tabs = document.querySelectorAll('.tabs__tab');
            Array.prototype.forEach.call(tabs, tab => {
                tab.classList.remove('tabs__tab--active');
            });
            el.parentElement.classList.add('tabs__tab--active');
        }
    }
]);
