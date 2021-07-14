<nav class="MainMenuMobile">
  @if (has_nav_menu('main_navigation_mobile'))
    {!! wp_nav_menu(['theme_location' => 'main_navigation_mobile', 'menu_class' => 'MainMenuMobile_list', 'container' => false]) !!}
  @endif
</nav>
