<?php

add_action('after_setup_theme', function() {
    new \Codelight\Theme\Application();
}, 0);
