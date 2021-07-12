<?php

namespace Codelight\Theme;

use Codelight\Theme\PostTypes\ExamplePostType;

/**
 * This class is responsible for bootstrapping the whole theme.
 *
 * Class Application
 * @package Codelight\Theme
 */
class Application
{
    /**
     * The list of service providers to initialize on startup.
     *
     * @var array
     */
    protected $serviceProviders = [
        ThemeServiceProvider::class,
    ];

    /**
     * Start the theme. This should be ran on after_setup_theme with priority 0.
     */
    public function __construct()
    {
        $this->setupPostTypes();
        $this->setupBlocks();
        $this->loadServiceProviders();
    }

    /**
     * Set up custom post types using PostTypes library.
     * See https://github.com/jjgrainger/PostTypes
     */
    protected function setupPostTypes()
    {
        $examplePostType = new ExamplePostType();
        $examplePostType->setup();
    }

    /**
     * Set up blocks via ACF Blocks library.
     * See https://github.com/codelight-eu/acf-blocks
     */
    protected function setupBlocks()
    {
        $blocks = \Codelight\ACFBlocks\Blocks::getInstance();
        $blocks->init([
            'namespace'  => "Codelight\Theme\Blocks",
            'blocktypes' => [
                'ContentBuilder',
            ],
        ]);
    }

    /**
     * Load our theme service providers.
     * See https://gitlab.com/codelight/packages/foundation
     */
    protected function loadServiceProviders()
    {
        add_filter('codelight/foundation/providers', function(array $providers) {
            return $providers + $this->serviceProviders;
        });
    }
}
