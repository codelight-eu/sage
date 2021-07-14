<?php

namespace Codelight\Theme\WooCommerce\CachedCart;

/**
 * Class CachedCart
 *
 * Stores the cart amount and totals in a cookie.
 *
 * @package Codelight\Theme\CachedCart
 */
class CachedCart
{
    public const CART_AMOUNT_COOKIE_KEY = 'woocommerce_cart_count';
    public const CART_TOTAL_COOKIE_KEY  = 'woocommerce_cart_total';

    public function __construct()
    {
        add_action('wp_loaded', [$this, 'setCartCookies'], 100);
        add_action('woocommerce_ajax_added_to_cart', [$this, 'setCartCookies']);
    }

    public function setCartCookies()
    {
        if (is_admin() && !wp_doing_ajax()) {
            return;
        }

        if (!WC()->cart) {
            return;
        }

        $cartCount = WC()->cart->get_cart_contents_count();
        $cartTotal = WC()->cart->get_cart_total();

        setcookie(
            self::CART_AMOUNT_COOKIE_KEY,
            $cartCount,
            time() + MONTH_IN_SECONDS,
            '/'
        );

        setcookie(
            self::CART_TOTAL_COOKIE_KEY,
            $cartTotal,
            time() + MONTH_IN_SECONDS,
            '/'
        );
    }
}
