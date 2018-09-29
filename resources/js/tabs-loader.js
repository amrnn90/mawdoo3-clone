export default {
    onEnter: function() {
        const tabs = document.querySelectorAll('.tabs__tab a');
        Array.prototype.forEach.call(tabs, tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();

                const url = tab.getAttribute('href');

                axios.get(url)
                .then(({data}) => {
                  const temp = document.createElement('html');
                  temp.innerHTML = data;
                    const container = document.querySelector('.posts-grid');
                    container.innerHTML = temp.querySelector('.posts-grid').innerHTML;
                });
            })
        });
    },
    onLeave: function() {
        // A new Transition toward a new page has just started.
    },

};