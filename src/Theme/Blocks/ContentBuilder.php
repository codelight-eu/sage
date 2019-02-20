<?php

namespace Codelight\Theme\Blocks;

use Codelight\ACFBlocks\FlexibleContentBlockType;

class ContentBuilder extends FlexibleContentBlockType
{
    protected $config = [
        'name'      => 'content_builder',
        'template'  => 'blocks.content-builder',
        'blocks'    => [
            // "Codelight\Theme\Blocks\ContentBuilder\Example",
        ],
    ];
    public function init()
    {
        $this->getFieldsBuilder()
             ->setGroupConfig('title', 'Content Blocks')
             ->setGroupConfig('hide_on_screen', ['the_content'])
             ->setLocation('post_type', '==', 'page')
                ->and('page_template', '!=', 'views/template-static.blade.php');

        foreach ($this->config['blocks'] as $blockName) {
            $this->registerBlockType($blockName);
        }
    }
}
