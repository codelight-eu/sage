<?php

namespace Codelight\Theme;

use Codelight\Foundation\Abstracts\ServiceProvider;
use Codelight\Foundation\Abstracts\ServiceProviderInterface;

class ThemeServiceProvider extends ServiceProvider implements ServiceProviderInterface
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
    ];
}
