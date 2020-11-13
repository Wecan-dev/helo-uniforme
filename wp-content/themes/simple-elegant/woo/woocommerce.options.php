<?php

/**
 * @since 2.3
 */

/* ARCHIVE PAGE
------------------------------------------------------------ */
$options[ 'products_per_page' ] = array(
    'name' => esc_html__( 'Custom number of products per page', 'simple-elegant' ),
    'type' => 'text',
    'std' => 8,

    'section' => 'woocommerce_archive',
);

$options[ 'shop_column' ] = array(
    'name' => esc_html__( 'Main shop column layout', 'simple-elegant' ),
    'type' => 'radio',
    'options' => array(
        '2' => esc_html__( '2 Columns', 'simple-elegant' ),
        '3' => esc_html__( '3 Columns', 'simple-elegant' ),
        '4' => esc_html__( '4 Columns', 'simple-elegant' ),
    ),
    'std' => '4',
    'section' => 'woocommerce_archive',
);

$options[ 'shop_sidebar' ] = array(
    'name' => esc_html__( 'Main shop sidebar', 'simple-elegant' ),
    'type' => 'radio',
    'options' => array(
        'fullwidth' => esc_html__( 'Fullwidth', 'simple-elegant' ),
        'left' => esc_html__( 'Sidebar Left', 'simple-elegant' ),
        'right' => esc_html__( 'Sidebar Right', 'simple-elegant' ),
    ),
    'std' => 'fullwidth',
    'section' => 'woocommerce_archive',
);

$options[ 'shop_tax_column' ] = array(
    'name' => esc_html__( 'Categories, tags.. column layout', 'simple-elegant' ),
    'type' => 'radio',
    'options' => array(
        '' => esc_html__( 'Inherit', 'simple-elegant' ),
        '2' => esc_html__( '2 Columns', 'simple-elegant' ),
        '3' => esc_html__( '3 Columns', 'simple-elegant' ),
        '4' => esc_html__( '4 Columns', 'simple-elegant' ),
    ),
    'std' => '',
    'section' => 'woocommerce_archive',
);

$options[ 'shop_tax_sidebar' ] = array(
    'name' => esc_html__( 'Categories, tags.. sidebar', 'simple-elegant' ),
    'type' => 'radio',
    'options' => array(
        '' => esc_html__( 'Inherit', 'simple-elegant' ),
        'fullwidth' => esc_html__( 'Fullwidth', 'simple-elegant' ),
        'left' => esc_html__( 'Sidebar Left', 'simple-elegant' ),
        'right' => esc_html__( 'Sidebar Right', 'simple-elegant' ),
    ),
    'std' => '',
    'section' => 'woocommerce_archive',
);

$options[] = array(
    'name' => esc_html__( 'Loop item', 'simple-elegant' ),
    'type' => 'heading',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_item_spacing' ] = array(
    'name' => esc_html__( 'Item Spacing', 'simple-elegant' ),
    'type' => 'radio',
    'options' => array(
        'small' => esc_html__( 'Small', 'simple-elegant' ),
        'large' => esc_html__( 'Large', 'simple-elegant' ),
    ),
    'std' => 'small',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_categories' ] = array(
    'name' => esc_html__( 'Show product categories', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_title' ] = array(
    'name' => esc_html__( 'Show product title', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_rating' ] = array(
    'name' => esc_html__( 'Show product rating', 'simple-elegant' ),
    'desc' => esc_html__( 'You have to exit Customizer after changing this option to see changes', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_price' ] = array(
    'name' => esc_html__( 'Show product price', 'simple-elegant' ),
    'desc' => esc_html__( 'You have to exit Customizer after changing this option to see changes', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_wishlist' ] = array(
    'name' => esc_html__( 'Wishlist Button', 'simple-elegant' ),
    'desc' => esc_html__( 'You have to install "YITH WooCommerce Wishlist" plugin to have Wishlist feature.', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_quick_view' ] = array(
    'name' => esc_html__( 'Quick View button', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

$options[ 'product_loop_secondary_image' ] = array(
    'name' => esc_html__( 'Secondary image feature', 'simple-elegant' ),
    'desc' => esc_html__( 'That is the feature when you hover on product thumbnail, it shows secondary image selected from product image gallery', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    'section' => 'woocommerce_archive',
);

/* SINGLE PAGE
------------------------------------------------------------ */
$options[ 'woocommerce_lightbox' ] = array(
    'name' => esc_html__( 'Lightbox for product images', 'simple-elegant' ),
    'desc' => esc_html__( 'You have to exit Customizer after changing this option to see changes', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    
    'section' => 'woocommerce_single',
);

$options[ 'woocommerce_zoom' ] = array(
    'name' => esc_html__( 'Zoom effect for product images', 'simple-elegant' ),
    'desc' => esc_html__( 'You have to exit Customizer after changing this option to see changes', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'false',
    
    'section' => 'woocommerce_single',
);

$options[ 'product_single_sidebar' ] = array(
    'name' => esc_html__( 'Single Product Sidebar', 'simple-elegant' ),
    'type' => 'radio',
    'options' => array(
        'right' => esc_html__( 'Sidebar Right', 'simple-elegant' ),
        'left' => esc_html__( 'Sidebar Left', 'simple-elegant' ),
        'fullwidth' => esc_html__( 'Fullwidth', 'simple-elegant' ),
    ),
    'std' => 'fullwidth',
    
    'section' => 'woocommerce_single',
);

$options[ 'product_single_share' ] = array(
    'name' => esc_html__( 'Single Product Social Share Icons', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',
    
    'section' => 'woocommerce_single',
);

/* CART
------------------------------------------------------------ */
$options[ 'header_cart' ] = array(
    'name' => esc_html__( 'Show header cart?', 'simple-elegant' ),
    'type' => 'radio',
    'options' => withemes_enable_options(),
    'std' => 'true',

    'section' => 'woocommerce_cart',
);