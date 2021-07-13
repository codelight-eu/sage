<div class="Navbar">
  <div class="Navbar_mainWrap">
    <div class="container">
      <div class="Navbar_row row flex-nowrap">
        <div class="Navbar_col Navbar_col-left Navbar_col-brand">
          <a href="{{ home_url('/') }}" class="Navbar_brand">
            <i><strong>Brand</strong></i>
          </a>
        </div>

        <div class="Navbar_col Navbar_col-center Navbar_col-menu"></div>

        <div class="Navbar_col Navbar_col-center Navbar_col-search">
          @include('partials.search')
        </div>

        <div class="Navbar_col Navbar_col-center Navbar_col-menu"></div>

        <div class="Navbar_col Navbar_col-right Navbar_col-cart">
          @include('partials.cart-button')
        </div>

        <div class="Navbar_col Navbar_col-right Navbar_col-menuToggle">
          @include('partials.burger-button', ['classNames' => ['js-mobileMenuPanelToggle']])
        </div>
      </div>

    </div>
  </div> {{-- /.Navbar_mainWrap --}}

  <div class="Navbar_menuWrap">
    <div class="container">
      <div class="Navbar_menu">
        @include('partials.main-menu')
      </div>
    </div>
  </div> {{-- /.Navbar_menuWrap --}}
</div>
