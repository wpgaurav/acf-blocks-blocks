<?php
/**
 * Register ACF block: Opinion Box
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'opinion-box',
    'title'             => __('Opinion Box'),
    'description'       => __('A custom opinion box block for sharing thoughts'),
    'render_template'   => 'blocks/opinion-box/opinion-box.php',
    'category'          => 'common',
    'icon'              => 'admin-comments',
    'keywords'          => ['opinion', 'box', 'feedback'],
    'enqueue_style'     => get_stylesheet_directory_uri() . '/blocks/opinion-box/opinion-box.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
        'jsx'    => true,
    ],
]);