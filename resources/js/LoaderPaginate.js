import axios from 'axios';

class LoaderPaginate {
  constructor(options) {
    for (let i=0; i < options.length; i++) {
      options[i] = Object.assign({}, {
        trigger: null,
        container: null,
        target: null,
        noMoreClass: "no-more-items",
        replace: false,
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
          this.load(option);
        }
      })
    })
  }

  getNextUrl(option, html = null) {
    html = html || document;
    const moreEl = html.querySelector(option.target);

    if (moreEl) {
    return moreEl.getAttribute('href');
    }

    return null;
  }

  load(option) {
    const nextUrl = option.nextUrl;
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
        
        option.nextUrl = this.getNextUrl(option, temp);
        this.checkIfNoMore(option);

        option.afterLoad(Object.assign({},option));

        option.currentEl = null;
      });
  }

  checkIfNoMore(option) {
    if (option.paginate && option.paginate.target) {
      const method = option.nextUrl ? 'remove' : 'add';
      const triggerEl = document.querySelector(option.trigger);
      triggerEl.classList[method](option.paginate.noMoreClass);
    }
  }

}


export default Loader;