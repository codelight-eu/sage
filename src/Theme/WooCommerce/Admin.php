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
        add_action('woocommerce_admin_order_data_after_order_details', [$this, 'renderOrderCompletedPageLink']);
        // add_filter('product_type_selector', [$this, 'removeProductTypes']);
        // add_filter('product_type_options', [$this, 'removeVirtualDownloadableProducts']);
        // add_filter('woocommerce_product_data_tabs', [$this, 'removeProductTabs']);
    }

    /**
     * Show a link to order completed page in each order's admin view for easier development.
     *
     * @param \WC_Order $order
     */
    public function renderOrderCompletedPageLink(\WC_Order $order)
    {
        if (!in_array($order->get_status(), ['processing', 'completed'])) {
            return;
        }

        $url = $order->get_checkout_order_received_url();
        echo "<a target='_blank' style='display: inline-block; margin-top: 10px;' href='{$url}'>View order complete page</a>";
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
