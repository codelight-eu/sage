<?php

namespace Codelight\Theme;

/**
 * Handles admin interface customizations.
 *
 * Class Admin
 * @package Codelight\Theme
 */
class Admin
{
    /**
     * Set up hooks.
     */
    public function __construct()
    {
        add_action('admin_menu', [$this, 'addMenusToAdminMenu']);
        add_action('init', [$this, 'cleanupEditorMenu']);
        add_filter('the_seo_framework_metabox_priority', [$this, 'setSeoFrameworkPriority']);
        add_filter('admin_footer_text', [$this, 'renderCodelightSignature']);
    }

    /**
     * Add Menus as a top-level admin interface item.
     */
    public function addMenusToAdminMenu()
    {
        add_menu_page(
            'Menus',
            'Menus',
            'edit_pages',
            'nav-menus.php',
            '',
            'dashicons-menu',
            40
        );
    }

    /**
     * For editors and shop_managers, remove Themes and Tools menu items to reduce clutter.
     */
    public function cleanupEditorMenu()
    {
        if (!$this->isEditor()) {
            return;
        }

        add_action('admin_menu', function() {
            remove_menu_page('themes.php');
            remove_menu_page('tools.php');
        });
    }

    /**
     * Ensure that the SEO metabox is among the lower priority items on various admin pages.
     *
     * @return string
     */
    public function setSeoFrameworkPriority(): string
    {
        return 'low';
    }

    /**
     * Add our signature to admin footer.
     *
     * @return string
     */
    public function renderCodelightSignature(): string
    {
        return 'Built with &#10084; by <a href="https://codelight.eu">Codelight</a>';
    }

    /**
     * Check if the current user has editor or shop_manager role.
     *
     * @return bool
     */
    protected function isEditor(): bool
    {
        $user  = wp_get_current_user();
        $roles = (array)$user->roles;

        foreach ($roles as $role) {
            if (in_array($role, ['editor', 'shop_manager'])) {
                return true;
            }
        }

        return false;
    }

}
