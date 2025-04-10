<?php
/**
 * Block Name: Email Form
 * Description: A custom email signup form block.
 */

// Register the block
if (function_exists('acf_register_block_type')) {
    acf_register_block_type(array(
        'name'              => 'email-form',
        'title'             => __('Email Form'),
        'description'       => __('A customizable email signup form.'),
        'render_template'   => 'blocks/email-form/email-form.php',
        'category'          => 'formatting',
        'icon'              => 'email-alt',
        'keywords'          => array('email', 'form', 'signup', 'newsletter'),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'mode' => false,
            'jsx' => true
        ),
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'is_preview' => true
                )
            )
        )
    ));
}