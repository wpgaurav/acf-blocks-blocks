<?php
// Hero Block
acf_register_block_type([
    'name'              => 'hero',
    'title'             => __('Hero'),
    'description'       => __('A customizable hero block with headline, subheadline, image, and CTA.'),
    'render_template'   => 'blocks/hero-block/hero-block.php',
    'category'          => 'common',
    'icon'              => 'cover-image',
    'keywords'          => ['hero', 'banner', 'header', 'featured'],
    'enqueue_style'     => get_stylesheet_directory_uri() . '/blocks/hero-block/hero.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'jsx' => true,
    ],
]);
