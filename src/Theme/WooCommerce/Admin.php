<?php

namespace Codelight\Theme\WooCommerce;

/**
 * WooCommerce-related admin customizations.
 *
 * Class Admin
 * @package Codelight\Theme\WooCommerce
 */
class Admin
{
    /**
     * Set up hooks.
     */
    public function __construct()
    {
        // add_filter('product_type_selector', [$this, 'removeProductTypes']);
        // add_filter('product_type_options', [$this, 'removeVirtualDownloadableProducts']);
        // add_filter('woocommerce_product_data_tabs', [$this, 'removeProductTabs']);
    }

    /**
     * Remove un-used product types.
     *
     * @param array $types
     * @return array
     */
    public function removeProductTypes(array $types): array
    {
        unset($types['grouped']);
        unset($types['external']);
        return $types;
    }

    /**
     *  Remove virtual and downloadable product checkboxes from admin.
     */
    public function removeVirtualDownloadableProducts(array $types): array
    {
        unset($types['virtual']);
        unset($types['downloadable']);
        return $types;
    }

    /**
     * Remove un-used product tabs.
     *
     * @param array $tabs
     * @return array
     */
    public function removeProductTabs(array $tabs): array
    {
        unset($tabs['advanced']);
        unset($tabs['woo-variation-swatches-pro']);
        return $tabs;
    }
}
