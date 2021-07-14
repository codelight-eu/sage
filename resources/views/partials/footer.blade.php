<footer class="Footer">
  <div class="Footer_mainWrap">
    <div class="container">
      <div class="row align-items-right Footer_row">
        <div class="Footer_col col">
          @include("partials.brand")
        </div>
        <div class="Footer_col col">
          @include("partials.footer-menu")
        </div>
        @php /*dynamic_sidebar('sidebar-footer')*/ @endphp
      </div>
    </div>
  </div>
  @include("partials.bottombar")
</footer>
