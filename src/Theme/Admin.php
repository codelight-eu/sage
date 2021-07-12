<?php

namespace Codelight\Theme;

use function App\template;

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
        add_action('admin_head', [$this, 'renderAdminCss']);
        add_action('login_header', [$this, 'renderLogo']);
        add_action('login_enqueue_scripts', [$this, 'setLoginStyles']);
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
     * Quick and easy way to output some admin CSS.
     */
    public function renderAdminCss()
    { ?>
        <style>

        </style>
    <?php }

    /**
     * Add custom styling to login page.
     */
    public function setLoginStyles()
    { ?>
        <style type="text/css">
            body {
                background-color: #fff !important;
            }

            .login .loov-logo {
                width: 320px;
                height: 25px;
                padding-bottom: 30px;
                margin: auto;
                margin-top: 50px;
            }

            .login .loov-logo a {
                display: block;
                width: 170px;
                padding-top: 130px;
                margin: auto;
            }

            .login .loov-logo .ScalingSvg {
                position: relative;
                padding-bottom: 36%;
            }

            .login .loov-logo .ScalingSvg_shape {
                position: absolute;
                height: 100%;
                width: 100%;
                left: 0;
                top: 0;
                fill: #483698;
            }

            .interim-login .loov-logo a {
                padding-top: 0;
                margin-bottom: 30px;
            }

            /**
             * Customize these colors for admin login page.
             */

            /*
            #wp-submit {
                background: #483698;
                border-color: #483698;
            }

            #wp-submit:hover {
                background: #2d2260;
                border-color: #2d2260;
            }

            .login input[type=text]:focus,
            .login input[type=password]:focus {
                border-color: #483698;
                box-shadow: 0 0 0 1px #483698;
            }
            */

            #login h1 {
                display: none;
            }
        </style>
    <?php }

    /**
     * Add custom logo to login page.
     */
    public function renderLogo()
    {
        // echo template('partials.admin.login-logo');
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
