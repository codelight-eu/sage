<?php

namespace Codelight\Theme\WooCommerce;

use Codelight\Foundation\Abstracts\ServiceProvider;
use Codelight\Foundation\Abstracts\ServiceProviderInterface;
use Codelight\Theme\WooCommerce\CachedCart\CachedCart;
use Codelight\Theme\WooCommerce\Controllers\Cart;
use Codelight\Theme\WooCommerce\CachedCart\WpRocket;

class WooCommerceServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    /**
     * Classes of which there should always be just one single instance.
     *
     * @var array
     */
    public $singletons = [];

    /**
     * Classes that should be automatically initialized when the theme starts.
     *
     * @var array
     */
    public $autoload = [
        Admin::class,
        CachedCart::class,
        Cart::class,
        WpRocket::class,
    ];
}
