<?php
// CTA Block
acf_register_block_type([
    'name'              => 'cta',
    'title'             => __('Call to Action'),
    'description'       => __('A customizable call-to-action block with heading, description, and button.'),
    'render_template'   => 'blocks/cta-block/cta-block.php',
    'category'          => 'common',
    'icon'              => 'megaphone',
    'keywords'          => ['cta', 'call to action', 'button', 'conversion'],
    'enqueue_style'     => get_stylesheet_directory_uri() . '/blocks/cta-block/cta.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'jsx' => true,
    ],
]);
