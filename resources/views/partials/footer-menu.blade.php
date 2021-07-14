<nav class="FooterMenu">
  @if (has_nav_menu('navigation_footer'))
    {!! wp_nav_menu(['theme_location' => 'navigation_footer', 'menu_class' => 'FooterMenu_list', 'container' => false]) !!}
  @endif
</nav>
