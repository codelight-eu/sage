<nav class="UtilMenu">
  @if (has_nav_menu('navigation_topbar'))
    {!! wp_nav_menu(['theme_location' => 'navigation_topbar', 'menu_class' => 'UtilMenu_list', 'container' => false]) !!}
  @endif
</nav>
