<?php

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', \App\asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', \App\asset_path('scripts/main.js'), ['jquery'], null, true);
    
    wp_localize_script('sage/main.js', 'theme', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Register navigation menus
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
add_action('after_setup_theme', function() {
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);
}, 20);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable WP Cleanup features when plugin is activated
     * @link https://github.com/codelight-eu/codelight-wp-cleanup
     */
    add_theme_support('cl-wp-cleanup');
    add_filter('cl_remove_widgets', function ($widgets) {
        return ['misc'];
    });

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    // add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Disable XML-RPC. Note that this still allows accessing the endpoint,
 * so it should also be disabled via htaccess.
 */
add_filter( 'xmlrpc_enabled', function() {
    return false;
});

/**
 * Whitelist formats that can be used in content editor
 */
add_filter('tiny_mce_before_init', function ($init) {
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3';
    return $init;
});
