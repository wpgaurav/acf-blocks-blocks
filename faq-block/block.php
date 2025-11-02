<?php
// FAQ Block
acf_register_block_type([
    'name'              => 'faq',
    'title'             => __('FAQ'),
    'description'       => __('A FAQ block with questions and answers, including schema support.'),
    'render_template'   => 'blocks/faq-block/faq-block.php',
    'category'          => 'common',
    'icon'              => 'editor-help',
    'keywords'          => ['faq', 'question', 'answer', 'help'],
    'enqueue_style'     => get_stylesheet_directory_uri() . '/blocks/faq-block/faq.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'jsx' => true,
    ],
]);
