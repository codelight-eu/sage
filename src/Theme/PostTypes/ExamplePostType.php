<?php

namespace Codelight\Theme\PostTypes;

use PostTypes\PostType;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Register a custom post type properly.
 * See https://github.com/jjgrainger/PostTypes
 *
 * Class ExamplePostType
 *
 * @package Codelight\Theme\PostTypes
 */
class ExamplePostType
{
    public function setup()
    {
        $this->registerPostType();
        $this->registerFields();
    }

    protected function registerFields()
    {
        $fieldsBuilder = new FieldsBuilder('example', ['title' => 'Example field']);
        $fieldsBuilder
            ->addText('example')
            ->setLocation('post_type', '==', 'example');

        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group($fieldsBuilder->build());
        }
    }

    protected function registerPostType()
    {
        $names = [
            'name'     => 'example',
            'singular' => 'Example',
            'plural'   => 'Examples',
            'slug'     => 'example',
        ];

        $options = [
            'public'              => false,
            'show_ui'             => true,
            'publicly_queryable'  => true,
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'has_archive'         => false,
            'supports'            => ['title'],
            'menu_icon'           => 'dashicons-carrot',
        ];

        $date = new PostType($names, $options);
        $date->register();
    }
}
