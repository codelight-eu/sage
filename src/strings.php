<?php

/**
 * This loads the .mo files from resources folder.
 */
load_theme_textdomain('sage', get_stylesheet_directory());

/**
 * Register aliases and their corresponding strings.
 * See https://github.com/codelight-eu/babelfish
 */
babelfish()->register([
    'search'                                  => __('Search', 'sage'),
    'date'                                    => __('Date', 'sage'),
    'author'                                  => __('Author', 'sage'),
]);
