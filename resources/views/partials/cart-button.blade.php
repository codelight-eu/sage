<div class="CartButton">
  <a href="{{ esc_url( wc_get_cart_url() ) }}" class="CartButton_link">
    <div class="CartButton_icon">
      @include('partials.icon', ['name' => 'cart'])
    </div>
    <div class="CartButton_text">
      {{ __('Cart', 'woocommerce') }}
    </div>
  </a>
</div>
