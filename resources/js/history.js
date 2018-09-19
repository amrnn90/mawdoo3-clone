const set = _.set;
const get = _.get;

export default class History {
  constructor() {
    this.forward = 'forward';
    this.back = 'back';

    if(window.history.state === null) {
      const state = sessionStorage.getItem('history') || 0;
      window.history.replaceState(parseInt(state), null, window.location);
    }

    this.prevState = 0;
    this.state = window.history.state;

    window.addEventListener('popstate', event => {
      sessionStorage.setItem('history', event.state);
      this.prevState = this.state;
      this.state = event.state;
    });
  }

  goTo(url) {
    this.prevState = this.state;
    this.state = window.history.state + 1;
    window.history.pushState(this.state, null, url);
  }

  direction() {
    return this.state <= this.prevState ? this.back : this.forward;
  }

  setSessionData(data = {}) {
    sessionStorage.setItem('historyData', JSON.stringify(data));
  }

  getSessionData() {
    const data = sessionStorage.getItem('historyData') || null;
    if(data === null) return {};
    return JSON.parse(data);
  }

  set(key, value) {
    this.setSessionData(set(this.getSessionData(), this.state + '.' + key, value));
  }

  setPrev(key, value) {
    this.setSessionData(set(this.getSessionData(), this.prevState + '.' + key, value));
  }

  get(key, defaultValue = null) {
    return get(this.getSessionData(), this.state + '.' + key, defaultValue);
  }

  getPrev(key, defaultValue = null) {
    return get(this.getSessionData(), this.prevState + '.' + key, defaultValue);
  }
};