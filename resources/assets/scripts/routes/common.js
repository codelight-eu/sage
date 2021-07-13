import mobileMenuPanel from '../components/mobileMenuPanel';

export default {
  init() {
    // JavaScript to be fired on all pages
    // init mobile menu
    mobileMenuPanel();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
