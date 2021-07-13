<nav class="MainMenu">
  @if (has_nav_menu('main_navigation_desktop'))
    {!! wp_nav_menu(['theme_location' => 'main_navigation_desktop', 'menu_class' => 'MainMenu_list', 'container' => false]) !!}
  @endif
</nav>
