<?php
/**
 * Register ACF block: Coupon Code
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'cb-coupon-code',
    'title'             => __('Coupon Code'),
    'description'       => __('A coupon code block with offer details, copyable coupon code, and discount activation button.'),
    'render_template'   => 'blocks/coupon-code/coupon-code.php',
    'category'          => 'common',
    'icon'              => 'tickets',
    'keywords'          => ['coupon', 'discount', 'offer'],
    'enqueue_style'     => get_stylesheet_directory_uri() . '/blocks/coupon-code/coupon-code.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
    ],
]);