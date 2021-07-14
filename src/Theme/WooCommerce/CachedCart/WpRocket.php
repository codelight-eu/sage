<?php

namespace Codelight\Theme\WooCommerce\CachedCart;

/**
 * Class WPRocket
 *
 * Ensures that WP Rocket respects our dynamic cookies.
 *
 * @package Codelight\Theme\CachedCart
 */
class WpRocket
{
    public function __construct()
    {
        add_filter('rocket_cache_dynamic_cookies', [$this, 'setDynamicCookies']);
        add_filter('rocket_htaccess_mod_rewrite', [$this, 'disableModRewrite'], 72);
        add_action('after_rocket_clean_domain', [$this, 'regenerateConfigFile']);
    }

    /**
     * @param $cookies
     * @return array
     */
    public function setDynamicCookies(array $cookies)
    {
        $cookies[] = CachedCart::CART_AMOUNT_COOKIE_KEY;
        $cookies[] = CachedCart::CART_TOTAL_COOKIE_KEY;

        return $cookies;
    }

    /**
     * This is also required for dynamic cookies to work,
     * according to WP Rocket docs & examples.
     *
     * @return bool
     */
    public function disableModRewrite()
    {
        return false;
    }

    /**
     * It looks like dynamic cookies require the config file to be regenerated
     * every time cache is flushed.
     */
    public function regenerateConfigFile()
    {
        if (!function_exists('flush_rocket_htaccess')
            || !function_exists('rocket_generate_config_file')) {
            return;
        }

        // Update WP Rocket .htaccess rules.
        flush_rocket_htaccess();

        // Regenerate WP Rocket config file.
        rocket_generate_config_file();
    }
}
