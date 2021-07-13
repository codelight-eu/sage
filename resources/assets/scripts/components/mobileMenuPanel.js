import OverLayer from '../components/OverLayer';

const defaults = {
  className: {
    PREP_FOR_SHOW: 'st-prepFor-show',
    SHOW: 'st-show',
    BODY_SHOW: 'st-mobileMenuPanel-show',
  },
};

export default function (opts = {}) {
  const config = $.extend(defaults, opts);
  const elements = {
    menuContainer: document.getElementsByClassName('js-mobileMenuPanelContainer')[0],
    menu: document.getElementsByClassName('js-mobileMenuPanel')[0],
    menuToggle: document.getElementsByClassName('js-mobileMenuPanelToggle')[0],
  };

  if (!elements.menuContainer) {
    return;
  }

  const mobileMenuConfig = {
    className: {
      SCROLLBAR_MEASURER: 'ol-scrollbarMeasure-mobileMenu',
      OPEN: 'ol-overLayerIsOpen-mobileMenu',
    },
    eventPrefix: 'mobilemenu',
    conductShowAnimation: function (args) {
      const { element, finish, onTransitionEndOnce } = args;
      elements.menu.classList.add(config.className.PREP_FOR_SHOW);
      // reflow
      element.offsetHeight;
      onTransitionEndOnce(elements.menu, () => finish(), 700);
      elements.menu.classList.add(config.className.SHOW);
    },

    conductHideAnimation: function (args) {
      const { finish, onTransitionEndOnce } = args;

      onTransitionEndOnce(elements.menu, () => {
        elements.menu.classList.remove(config.className.PREP_FOR_SHOW);
        finish();
      }, 700);

      elements.menu.classList.remove(config.className.SHOW);
    },
  };

  const mainOverlayMenu = new OverLayer(elements.menuContainer, mobileMenuConfig);

  elements.menuContainer.addEventListener('mobilemenushow', () => {
    elements.menuToggle.classList.add('st-close');
    document.body.classList.add(config.className.BODY_SHOW);
  });

  elements.menuContainer.addEventListener('mobilemenuhide', () => {
    elements.menuToggle.classList.remove('st-close');
    document.body.classList.remove(config.className.BODY_SHOW);
  });

  elements.menuToggle.addEventListener('click', function (e) {
    e.preventDefault();
    mainOverlayMenu.toggle();
  });

  // close the filter when mobile sidepanel is opened
  $('body').on('postsfilterdrawershow', function() {
    mainOverlayMenu.hide();
  });
}
