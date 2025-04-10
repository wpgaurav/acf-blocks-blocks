<?php
/**
 * Block Registration: Coupon
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Register ACF Block
acf_register_block_type(array(
    'name'              => 'coupon',
    'title'             => __('Coupon', 'md'),
    'description'       => __('Display a Groupon-style coupon with code, discount, terms and expiration date.', 'md'),
    'render_template'   => dirname(__FILE__) . '/template.php',
    'category'          => 'formatting',
    'icon'              => 'tickets-alt',
    'keywords'          => array('coupon', 'discount', 'promo', 'offer'),
    'enqueue_assets'    => function() {
        // Add clipboard.js if needed
        if (!wp_script_is('clipboard', 'registered')) {
            wp_enqueue_script(
                'clipboard', 
                'https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js', 
                array(), 
                '2.0.11', 
                true
            );
        }
    },
    'supports'          => array(
        'align'           => array('wide', 'full'),
        'anchor'          => true,
        'customClassName' => true,
        'jsx'             => true,
        'color'           => array(
            'background'  => true,
            'text'        => true,
        ),
    ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                'coupon_code' => 'SAVE20',
                'coupon_discount' => '20% OFF',
                'is_preview'    => true,
            ),
        ),
    ),
));