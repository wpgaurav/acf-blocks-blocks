<?php 
add_action('acf/init', 'register_custom_acf_blocks');

function register_custom_acf_blocks() {

    // Register Product Review Block
    acf_register_block_type([
        'name'              => 'product-review',
        'title'             => __('Product Review'),
        'description'       => __('A custom product review block with structured data'),
        'render_template'   => 'product-review/product-review.php',
        'category'          => 'common',
        'icon'              => 'admin-comments',
        'keywords'          => ['review', 'product', 'rating'],
        'enqueue_style'     => get_stylesheet_directory_uri() . '/product-review/product-review.css?v=112',
        'supports'          => [
            'align'  => true,
            'mode'   => true,
            'anchor' => true,
        ],
    ]);

    // Register Opinion Box Block
    acf_register_block_type([
        'name'              => 'opinion-box',
        'title'             => __('Opinion Box'),
        'description'       => __('A custom opinion box block for sharing thoughts'),
        'render_template'   => 'opinion-box/opinion-box.php',
        'category'          => 'common',
        'icon'              => 'admin-comments', // You can change the icon if needed.
        'keywords'          => ['opinion', 'box', 'feedback'],
        'enqueue_style'     => get_stylesheet_directory_uri() . '/opinion-box/opinion-box.css?v=115',
        'supports'          => [
            'align'  => true,
            'mode'   => true,
            'anchor' => true,
            'jsx'    => true, // Enables inner blocks support in editor.
        ],
    ]);

    // Register Product Box Block
    acf_register_block_type([
        'name'              => 'product-box',
        'title'             => __('Product Box'),
        'description'       => __('A product box with image, title, rating, and description.'),
        'render_template'   => 'product-box/product-box.php',
        'category'          => 'common',
        'icon'              => 'cart',
        'keywords'          => ['product', 'box', 'rating'],
        'enqueue_style'     => get_stylesheet_directory_uri() . '/product-box/product-box.css?v=11',
        'supports'          => [
            'align'  => true,
            'mode'   => true,
            'anchor' => true,
            // 'jsx'    => true,
        ],
    ]);
     acf_register_block_type([
            'name'              => 'cb-coupon-code',
            'title'             => __('Coupon Code'),
            'description'       => __('A coupon code block with offer details, copyable coupon code, and discount activation button.'),
            'render_template'   => 'coupon-code/coupon-code.php',
            'category'          => 'common',
            'icon'              => 'tickets',
            'keywords'          => ['coupon', 'discount', 'offer'],
            'enqueue_style'     => get_stylesheet_directory_uri() . '/coupon-code/coupon-code.css?v=1',
            'supports'          => [
                'align'  => true,
                'mode'   => true,
                'anchor' => true,
            ],
        ]);
    acf_register_block_type([
            'name'              => 'pl_block',
            'title'             => __('Product Block'),
            'description'       => __('A product block with rank, icon, name, description, pricing, coupons, and offer buttons.'),
            'render_template'   => 'pl-block/pl-block.php',
            'category'          => 'common',
            'icon'              => 'products',
            'keywords'          => ['product', 'offer', 'pricing', 'coupon'],
            'enqueue_style'     => get_stylesheet_directory_uri() . '/pl-block/pl-block.css?v=1',
            'supports'          => [
                'align'  => true,
                'mode'   => true,
                'anchor' => true,
            ],
        ]);
        acf_register_block_type([
            'name'              => 'accordion',
            'title'             => __('Accordion'),
            'description'       => __('A customizable accordion block with FAQ schema support.'),
            'render_template'   => 'accordion-block/accordion-block.php',
            'category'          => 'common',
            'icon'              => 'list-view',
            'keywords'          => ['accordion', 'faq', 'toggle'],
            //  'enqueue_style'     => get_stylesheet_directory_uri() . 'accordion-block/accordion-block.css',
            'supports'          => [
                'align'  => true,
                'mode'   => true,
                'jsx' => true,
            ],
        ]);
        acf_register_block_type([
        'name'              => 'product_cards',
        'title'             => __('Product Cards'),
        'description'       => __('A customizable product card block.'),
        'render_template'   => 'product-cards/product-cards.php',
        'category'          => 'formatting',
        'icon'              => 'grid-view',
        'keywords'          => ['product', 'card', 'custom'],
        'enqueue_style'     => get_stylesheet_directory_uri() . '/product-cards/product-cards.css?v=1',
        'supports'          => ['align' => true,]
        ]);
        acf_register_block_type([
            'name'              => 'acf_section',
            'title'             => __('Section Block'),
            'description'       => __('A customizable container block that wraps inner blocks.'),
            'render_template'   => 'section-block/section-block.php',
            'category'          => 'layout',
            'icon'              => 'editor-insertmore',
            'keywords'          => ['section', 'container', 'wrapper'],
            'supports'          => [
                'align'     => true,
                'jsx'       => true,
                'mode'      => true,
                'multiple'  => true,
            ],
            'enqueue_script'    => get_stylesheet_directory_uri() . '/section-block/editor.js?v=1',
    ]);

}