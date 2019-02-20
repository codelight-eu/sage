<?php

namespace Codelight\Theme;

use Codelight\Theme\PostTypes\ExamplePostType;

class Application
{
    public function __construct()
    {
        $this->setupPostTypes();
        $this->setupBlocks();
    }

    public function setupPostTypes()
    {
        $examplePostType = new ExamplePostType();
        $examplePostType->setup();
    }

    public function setupBlocks()
    {
        $blocks = \Codelight\ACFBlocks\Blocks::getInstance();
        $blocks->init([
            'namespace'  => "Codelight\Theme\Blocks",
            'blocktypes' => [
                'ContentBuilder',
            ],
        ]);
    }
}
