/**
 * --------------------------------------------------------------------------
 * OverLayer.js - a simple framework for creating overlay menus
 * Inspired by Bootstrap (v4.3.1): modal.js
 * --------------------------------------------------------------------------
 */

import _defaultsDeep from 'lodash.defaultsdeep';

function addEventListenerOnce(target, type, listener) {
  target.addEventListener(type, function fn() {
    target.removeEventListener(type, fn);
    listener.apply(this, arguments);
  });
}

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

const VERSION = '1.0.0';
const ESCAPE_KEYCODE = 27;

const defaultSettings = {
  keyboard: true,
  className: {
    SCROLLBAR_MEASURER: 'ol-scrollbarMeasure',
    OPEN: 'ol-overLayerIsOpen',
  },
  selector: {
    FIXED_CONTENT: '.fixed-top, .fixed-bottom, .is-fixed, .sticky-top',
  },
  eventPrefix: 'ol',
};

const events = [
  {
    key: 'HIDE',
    type: 'hide',
  },
  {
    key: 'HIDDEN',
    type: 'hidden',
  },
  {
    key: 'SHOW',
    type: 'show',
  },
  {
    key: 'SHOWN',
    type: 'shown',
  },
];


class OverLayer {
  constructor(element, settings) {
    this._element = element;
    this._config = _defaultsDeep({}, settings, defaultSettings);
    this._isBodyOverflowing = false;
    this._scrollbarWidth = 0;
    this._conductShowAnimation = this._config.conductShowAnimation || this._defaultConductShowAnimation;
    this._conductHideAnimation = this._config.conductHideAnimation || this._defaultConductHideAnimation;
    this._setScrollbarCallback = this._config.setScrollbarCallback;
    this._resetScrollbarCallback = this._config.resetScrollbarCallback;
    this._events = {};
    events.forEach(event => {
      this._events[event.key] = new Event(
        this._config.eventPrefix + event.type,
        {
          bubbles: true,
        }
      );
    });
    this._state = {
      isShown: false,
      isTransitioning: false,
    };

    this._afterShowAnimation = this._afterShowAnimation.bind(this);
    this._afterHideAnimation = this._afterHideAnimation.bind(this);
    this._escapeEventListener = this._escapeEventListener.bind(this);
    this.show = this.show.bind(this);
  }

  // Getters

  static get VERSION() {
    return VERSION;
  }

  _escapeEventListener(e) {
    if (e.keyCode === ESCAPE_KEYCODE) {
      e.preventDefault();
      this.hide();
    }
  }

  _defaultConductShowAnimation() {
    this._element.style.display = 'block';
    this._afterShowAnimation();
  }

  _defaultConductHideAnimation() {
    this._element.style.display = 'none';
    this._afterHideAnimation();
  }

  _afterShowAnimation() {
    this._state.isShown = true;
    this._state.isTransitioning = false;
    if (this._config.keyboard) {
      document.addEventListener('keydown', this._escapeEventListener);
    }
    this._element.dispatchEvent(this._events.SHOWN);
  }

  _afterHideAnimation() {
    this._state.isShown = false;
    this._state.isTransitioning = false;
    this._resetScrollbar();
    this._element.style.display = 'none';
    this._element.dispatchEvent(this._events.HIDDEN);
  }

  onTransitionEndOnce(element, callback, transitionDuration) {
    let finished = false;

    addEventListenerOnce(element, 'transitionend', () => {
      if (!finished) {
        finished = true;
        callback();
      }
    });

    // if transitionend event doesn't trigger for some reason e.g. is not supported, then make sure
    // that whenfinished gets called anyway
    window.setTimeout(function () {
      if (!finished) {
        finished = true;
        callback();
      }
    }, transitionDuration);
  }

  toggle() {
    return this._state.isShown ? this.hide() : this.show();
  }

  show() {
    if (this._state.isShown || this._state.isTransitioning) {
      return;
    }

    this._element.dispatchEvent(this._events.SHOW);
    this._element.style.display = 'block';
    // start animating
    this._state.isTransitioning = true;

    this._checkScrollbar();
    this._setScrollbar();

    this._conductShowAnimation({
      onTransitionEndOnce: this.onTransitionEndOnce,
      element: this._element,
      finish: this._afterShowAnimation,
    });
  }

  hide() {
    if (!this._state.isShown || this._state.isTransitioning) {
      return;
    }
    this._element.dispatchEvent(this._events.HIDE);

    // start animating
    this._state.isTransitioning = true;

    document.removeEventListener('keydown', this._escapeEventListener);

    this._conductHideAnimation({
      onTransitionEndOnce: this.onTransitionEndOnce,
      element: this._element,
      finish: this._afterHideAnimation,
    });
  }

  _checkScrollbar() {
    const rect = document.body.getBoundingClientRect();
    this._isBodyOverflowing = rect.left + rect.right < window.innerWidth;
    this._scrollbarWidth = this._getScrollbarWidth();
  }

  _getScrollbarWidth() { // thx d.walsh
    const scrollDiv = document.createElement('div');
    scrollDiv.className = this._config.className.SCROLLBAR_MEASURER;
    document.body.appendChild(scrollDiv);
    const scrollbarWidth = scrollDiv.getBoundingClientRect().width - scrollDiv.clientWidth;
    document.body.removeChild(scrollDiv);
    return scrollbarWidth;
  }

  _setScrollbar() {
    if (this._isBodyOverflowing) {
      const fixedContent = [].slice.call(document.querySelectorAll(this._config.selector.FIXED_CONTENT));

      // Adjust fixed content margin
      fixedContent.forEach(element => {
        const calculatedMargin = getComputedStyle(element)['margin-right'];
        element.dataset.marginRight = calculatedMargin;
        element.style.marginRight = `${parseFloat(calculatedMargin) + this._scrollbarWidth}px`;
      });

      if (this._setScrollbarCallback) {
        this._setScrollbarCallback({
          element: this._element,
          scrollbarWidth: this._scrollbarWidth,
        });
      }

      // Adjust body padding
      const actualPadding = document.body.style.paddingRight;
      const calculatedPadding = getComputedStyle(document.body)['padding-right'];

      document.body.dataset.paddingRight = actualPadding;
      document.body.style.paddingRight = `${parseFloat(calculatedPadding) + this._scrollbarWidth}px`;
    }

    document.body.classList.add(this._config.className.OPEN);
  }

  _resetScrollbar() {
    const fixedContent = [].slice.call(document.querySelectorAll(this._config.selector.FIXED_CONTENT));

    // Restore fixed content margin
    fixedContent.forEach(element => {
      const margin = element.dataset.marginRight;
      if (typeof margin !== 'undefined') {
        element.removeAttribute('data-margin-right');
        element.style.marginRight = margin || '';
      }
    });

    if (this._resetScrollbarCallback) {
      this._resetScrollbarCallback({
        element: this._element,
        scrollbarWidth: this._scrollbarWidth,
      });
    }

    // Restore body padding
    const padding = document.body.dataset.paddingRight;
    document.body.removeAttribute('data-padding-right');
    document.body.style.paddingRight = padding || '';
    document.body.classList.remove(this._config.className.OPEN);
  }

  _setEscapeEvent() {
    if (this._isShown && this._config.keyboard) {
      $(this._element).on(Event.KEYDOWN_DISMISS, (event) => {
        if (event.which === ESCAPE_KEYCODE) {
          event.preventDefault();
          this.hide();
        }
      });
    } else if (!this._isShown) {
      $(this._element).off(Event.KEYDOWN_DISMISS);
    }
  }


  destroy() {

  }
}

export default OverLayer;
