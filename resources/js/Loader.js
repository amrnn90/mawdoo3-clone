import axios from 'axios';

class Loader {
  constructor(options) {
    for (let i=0; i < options.length; i++) {
      options[i] = Object.assign({}, {
        trigger: null,
        container: null,
        paginate: {
          target: null,
          noMoreClass: "no-more-items",
        },
        replace: false,
        updateUrl: true,
        updateTitle: true,
        afterLoad: () => {},
      }, options[i]);
    }
    this.options = options;

    this.initEvents();
  }

  initEvents() {

    window.addEventListener('click', (e) => {
      this.options.forEach(option => {
        if (e.target.matches(option.trigger)) {
          option.currentEl = e.target;
          e.preventDefault();
          this.load(option);
        }
      })
    })
  }

  getNextUrl(option, html = null) {
    if (option.paginate && option.paginate.target) {
      html = html || document;
      const moreEl = html.querySelector(option.paginate.target);
  
      if (moreEl) {
        return moreEl.getAttribute('href');
      }
    } else if (option.currentEl) {
      return option.currentEl.getAttribute('href');
    }
    return null;
  }

  load(option) {
    const nextUrl = option.currentEl.getAttribute('data-next-url') || this.getNextUrl(option);
    if (!nextUrl) return;

    axios.get(nextUrl)
      .then(({data}) => {
        const temp = document.createElement('html');
        temp.innerHTML = data;

        if (option.replace) {
          // TODO: should scroll to container?
          document.querySelector(option.container).innerHTML = temp.querySelector(option.container).innerHTML;
        } else {
          document.querySelector(option.container).insertAdjacentHTML('beforeend', temp.querySelector(option.container).innerHTML);
        }
        
        option.currentEl.setAttribute('data-next-url', this.getNextUrl(option, temp) || '');

        this.checkIfNoMore(option);

        if (option.updateTitle) {
          const newTitle = temp.querySelector('title').innerText;
          document.querySelector('title').innerText = newTitle;
        }

        if (option.updateUrl) {
          const state = Object.assign({}, history.state, {url: nextUrl});
          history.replaceState(state, '', nextUrl);
        }


        option.afterLoad({el: option.currentEl, url: nextUrl});

        option.currentEl = null;
      });
  }

  checkIfNoMore(option) {
    if (option.paginate && option.paginate.target) {
      const method = option.currentEl.getAttribute('data-next-url') ? 'remove' : 'add';
      option.currentEl.classList[method](option.paginate.noMoreClass);
    }
  }

}


export default Loader;