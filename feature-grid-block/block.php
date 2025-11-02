<?php
// Feature Grid Block
acf_register_block_type([
    'name'              => 'feature-grid',
    'title'             => __('Feature Grid'),
    'description'       => __('A grid layout to showcase features with icons, titles, and descriptions.'),
    'render_template'   => 'blocks/feature-grid-block/feature-grid-block.php',
    'category'          => 'common',
    'icon'              => 'grid-view',
    'keywords'          => ['features', 'grid', 'services', 'benefits'],
    'enqueue_style'     => get_stylesheet_directory_uri() . '/blocks/feature-grid-block/feature-grid.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'jsx' => true,
    ],
]);
