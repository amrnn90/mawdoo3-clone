import  'waypoints/lib/noframework.waypoints';

let homeHeaderSearch = null;
let homeHeaderCompact = null;

export default {
    onEnter: () => {
        if (document.querySelector('#homepage')) {
            const heroSearch = document.querySelector('#hero-search');
            const header = document.querySelector('.page-header');

            homeHeaderSearch = new Waypoint({
                element: heroSearch,
                handler: function(direction) {
                    const method = direction == 'down' ? 'add' : 'remove';
                    header.classList[method]('page-header--with-search');
                    heroSearch.classList[method]('is-hidden');
                },
                offset: 170
            });
            let pageContent = document.querySelector('.page-content');
            homeHeaderCompact = new Waypoint({
                offset: -1,
                element: pageContent,
                handler: function(direction) {
                    const method = direction == 'down' ? 'add' : 'remove';
                    header.classList[method]('page-header--compact');
                }
            });
        }
    },
    onLeave: () => {
        if (homeHeaderSearch) {
            homeHeaderSearch.destroy();
            homeHeaderSearch = null;
        }
        if (homeHeaderCompact) {
            homeHeaderCompact.destroy();
            homeHeaderCompact = null;
        }
    }
};