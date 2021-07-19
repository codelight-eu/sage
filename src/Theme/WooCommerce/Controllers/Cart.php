<?php


namespace Codelight\Theme\WooCommerce\Controllers;


class Cart
{
    public function __construct()
    {
        add_action('woocommerce_before_cart', [$this, 'cartWrapperStart']);
        add_action('woocommerce_after_cart', [$this, 'cartWrapperEnd']);
    }

    public function cartWrapperStart() {
        echo "<div class='container'>";
    }

    public function cartWrapperEnd() {
        echo "</div>";
    }
}
