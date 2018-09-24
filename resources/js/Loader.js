import axios from 'axios';

class Loader {
  constructor(options) {
    this.options = Object.assign({}, {
      containerEl: null,
      items: '.infinite-item',
      more: '.infinite-more-link',
      buttonEl: null,
      replace: false,
      // loadingClass: 'infinite-loading',
      noMoreClass: 'no-more-items',
      // onBeforePageLoad: () => {},
      // onAfterPageLoad: () => {},
    }, options);

    this.initEvents();
    this.nextUrl = this.getNextUrl();
    this.checkIfNoMore();
  }

  initEvents() {
    if (this.options.buttonEl) {
      this.options.buttonEl.addEventListener('click', (e) => {
        e.preventDefault();
  
        this.load();
      });
    }
  }

  getNextUrl(html = null) {
    html = html || document;
    const moreEl = html.querySelector(this.options.more);

    if (moreEl) {
      return moreEl.getAttribute('href');
    }
    return null;
  }

  load() {
    const nextUrl = this.nextUrl;
    if (!nextUrl) return;

    axios.get(nextUrl)
      .then(({data}) => {
        const temp = document.createElement('html');
        temp.innerHTML = data;

        if (this.options.replace) {
          // TODO: should scroll to container?
          const oldItems = this.options.containerEl.querySelectorAll(this.options.items);
          Array.prototype.forEach.call(oldItems, (item) => {
            item.remove();
          });
        }
        
        const items = temp.querySelectorAll(this.options.items);
        Array.prototype.forEach.call(items, (item) => {
          this.options.containerEl.appendChild(item);
        });

        this.nextUrl = this.getNextUrl(temp);
        this.checkIfNoMore();
      });
  }

  checkIfNoMore() {
    if (this.options.buttonEl) {
      const method = this.nextUrl ? 'remove' : 'add';
      this.options.buttonEl.classList[method](this.options.noMoreClass);
      this.options.containerEl.classList[method](this.options.noMoreClass);
    }
  }

}


export default Loader;