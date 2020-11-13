<?php
if ( ! function_exists('withemes_woocommerce_installed') ) :
function withemes_woocommerce_installed() {
    return class_exists( 'WooCommerce' );
}
endif;

if ( !class_exists( 'Withemes_WooCommerce' ) ) :
/**
 * WooCommerce class
 *
 * @since 1.3
 * @modified since 2.0
 * @improved in 2.3
 */
class Withemes_WooCommerce
{   
    
    /**
	 * Construct
	 */
	public function __construct() {
	}
    
    /**
	 * The one instance of class
	 *
	 * @since 1.3
	 */
	private static $instance;

	/**
	 * Instantiate or return the one class instance
	 *
	 * @since 1.3
	 *
	 * @return class
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
    
    /**
     * Initiate the class
     * contains action & filters
     *
     * @since 1.3
     */
    public function init() {
        
        /**
         * Disable WooCommerce style
         * @since 2.3
         */
//        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
        
        /**
         * Theme Support
         * @since 2.3
         */
        add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
        
        /**
         * Disable default shop title to replace it by withemes title
         * @since 2.3
         */
        add_filter( 'woocommerce_show_page_title', '__return_false' );
        remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
        remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
        
        /**
         * ------------------------------------------       COMMON PROBLEMS         ------------------------------------------
         */
        // Posts per page
        add_filter( 'loop_shop_per_page', array( $this, 'products_per_page' ), 20 );
        
        // column
        add_filter( 'loop_shop_columns', array( $this, 'loop_columns' ), 10 );
        add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_args' ) );
        add_filter( 'woocommerce_upsell_display_args', array( $this, 'upsell_args' ) );
        
        // sidebar
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
        add_action( 'woocommerce_sidebar', array( $this, 'sidebar' ) );
        
        /**
         * Pagination prev/next
         */
        add_filter( 'woocommerce_pagination_args', array( $this, 'woocommerce_pagination_args' ) );
        
        // Body Class
        if ( withemes_woocommerce_installed() ) {
            
            // WooCommerce Options
            add_filter( 'withemes_panels', array( $this, 'panels' ) );
            
            add_filter( 'withemes_sections', array( $this, 'sections' ) );
            
            add_filter( 'withemes_options', array( $this, 'options' ) );
            
            add_action( 'widgets_init', array( $this, 'widgets_init' ) );
            
            add_filter( 'withemes_sidebar_state', array( $this, 'sidebar_state' ) );
            add_filter( 'body_class', array( $this, 'body_class' ), 22 );
            
        }
        
        /**
         * ------------------------------------------       CATALOG LAYOUT         ------------------------------------------
         */
        /**
         * wrap shop page by a #wi-before-content .container
         */
        add_action('woocommerce_before_main_content', array( $this, 'wrapper_start' ), 0 );
        add_action('woocommerce_before_main_content', array( $this, 'wrapper_end' ), 100);
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
        
        /**
         * wrap results count & catalog order by a div class="catalog-meta-wrapper"
         */
        add_action( 'woocommerce_before_shop_loop', array( $this, 'old_title' ), 12 );
        add_action( 'woocommerce_before_shop_loop', array( $this, 'div_before_results_count' ), 15 );
        add_action( 'woocommerce_before_shop_loop', array( $this, 'div_after_catalog_ordering' ), 35 );
        
        /**
         * wrap ul class="products" by a div class="wi-catalog"
         */
        add_action( 'woocommerce_before_shop_loop', array( $this, 'div_before_ul' ), 50 );
        add_action( 'woocommerce_after_shop_loop', array( $this, 'div_after_ul' ), 50 );
        
        
        /**
         * append <div class="product-inner" /> inside each product item in loop
         */
        add_action( 'woocommerce_before_shop_loop_item', array( $this, 'div_inner_open' ), 1 );
        add_action( 'woocommerce_after_shop_loop_item', array( $this, 'div_inner_close' ), 50 );
        
        /**
         * <div class="product-thumbnail" />
         * thumbnail-overlay in case we need (but not this moment)
         */
        add_action( 'woocommerce_before_shop_loop_item', array( $this, 'content_product_thumbnail_open' ), 4 );
        add_action( 'woocommerce_before_shop_loop_item', array( $this, 'content_product_thumbnail_open_overlay' ), 11 );
        add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'content_product_thumbnail_close' ), 14 );
        
        if ( 'false' === get_option( 'withemes_product_loop_price', 'true' ) ) {
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        }
        if ( 'false' === get_option( 'withemes_product_loop_rating', 'true' ) ) {
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        }
        
        /**
         * Image Flipper
         */
        add_action( 'woocommerce_before_shop_loop_item', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 12 );
        
        /**
         * Reposition link close </a> & add_to_cart button
         */
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 13 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11 );
        
        // Reposition Sale Flash to make it inside the <div class="product-thumbnail" />
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 15 );
        
        /**
         * wrap <div class="product-text" />
         */
        add_action( 'woocommerce_shop_loop_item_title', array( $this, 'content_product_open' ), 2 );
        add_action( 'woocommerce_after_shop_loop_item', array( $this, 'content_product_close' ), 40 );
        
        /**
         * add product cats to loop
         */
        add_action( 'woocommerce_shop_loop_item_title', array( $this, 'content_product_cats' ), 8 );
        
        /**
         * add custom title so that link goes inside heading tag <h2 class="product-title" />
         */
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        add_action( 'woocommerce_shop_loop_item_title', array( $this, 'content_product_title' ), 10 );
        
        /**
         * ------------------------------------------       SINGLE         ------------------------------------------
         */
        
        // gallery column
        add_filter( 'woocommerce_product_thumbnails_columns', array( $this, 'woocommerce_product_thumbnails_columns' ) );
        
        // the title
//        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
//        add_action(  'woocommerce_single_product_summary', array( $this, 'single_title' ), 5 );
        
        // wrap #single-product-upper
        add_action( 'woocommerce_before_single_product_summary', array( $this, 'single_div_open' ), 0 );
        add_action( 'woocommerce_after_single_product_summary', array( $this, 'single_div_close' ), 0 );
        
        /**
         * Quick View
         * @since 2.3
         */
        add_action( 'woocommerce_before_shop_loop_item', array( $this, 'quickview_btn' ), 8 );
        add_action( 'wp_ajax_product_preview', array( $this, 'product_preview' ) );
        add_action( 'wp_ajax_nopriv_product_preview', array( $this, 'product_preview' ) );
        add_action( 'wp_footer', array( $this, 'quick_view' ) );
        
        add_action( 'woocommerce_preview_product_summary', 'woocommerce_template_single_title', 5 );
        add_action( 'woocommerce_preview_product_summary', 'woocommerce_template_single_price', 10 );
        add_action( 'woocommerce_preview_product_summary', 'woocommerce_template_single_excerpt', 20 );
        add_action( 'woocommerce_preview_product_summary', 'woocommerce_template_loop_add_to_cart', 30 );
        add_action( 'woocommerce_preview_product_summary', 'woocommerce_template_single_meta', 40 );
        
        /**
         * Wishlist
         * @since 2.3
         */
        add_action( 'woocommerce_shop_loop_item_title', array( $this, 'wishlist_button' ), 5 );
        add_action( 'wp_ajax_withemes_update_wishlist_count', array( $this, 'wishlist_ajax_update_count' ) );
        add_action( 'wp_ajax_nopriv_withemes_update_wishlist_count', array( $this, 'wishlist_ajax_update_count' ) );
        
        add_action( 'withemes_navigation_custom_item', array( $this, 'wishlist_myaccount_nav_link' ) );
        
        // add account nav to wishlist page
        add_action( 'yith_wcwl_before_wishlist_form', array( $this, 'myaccount_nav_to_wishlist_page' ) );
        add_filter( 'post_class', array( $this, 'product_class' ) );
        
        /**
         * Off Canvas Cart
         */
        if ( class_exists( 'WooCommerce' ) ) {
            add_action( 'wp_footer', array( $this, 'cart_offcanvas' ) );
        }
        add_filter( 'add_to_cart_fragments', array( $this, 'offcanvas_add_to_cart_fragment' ) );
        
    }
    
    function sidebar_state( $position ) {
        
        $state = '';
        
        if ( is_shop() ) {
            
            $state = get_option( 'withemes_shop_sidebar', 'fullwidth' );
            
        } elseif ( is_product_taxonomy() ) {
            
            $state = get_option( 'withemes_shop_tax_sidebar', '' );
            
            if ( $state === '' ) {
                
                $state = get_option( 'withemes_shop_sidebar', 'fullwidth' );
                
            }
        
        } elseif ( is_singular( 'product' ) ) {
        
            $state = get_option( 'withemes_product_single_sidebar', 'fullwidth' );
        
        }
        
        if ( 'left' === $state || 'right' === $state ) $position = $state;
        elseif ( 'fullwidth' === $state ) $position = false;
        
        return $position;
                
    }
    
    /**
     * Displays Shop Sidebar
     */
    function sidebar() {
        
        withemes_maybe_sidebar( 'shop' );
        
    }
    
    function old_title() {
        
        withemes_shop_title( 'old' );
    
    }
    
    function div_before_results_count() {
        
        echo '<div class="catalog-meta-wrapper">';
        
    }
    
    function div_after_catalog_ordering() {
        
        echo '</div><!-- .catalog-meta-wrapper -->';
        
    }
    
    function div_before_ul() {
        echo '<div id="wi-catalog" class="wi-catalog">';
    }
    
    function div_after_ul() {
        echo '</div>';
    }
    
    function div_inner_open() {
        echo '<div class="product-inner">';
    }
    function div_inner_close() {
        echo '</div><!-- .product-inner -->';
    }
    function content_product_open() {
        echo '<div class="product-text">';
    }
    function content_product_close() {
        echo '</div><!-- .product-text -->';
    }
    
    function theme_setup() {
        
        /* since 1.3 */
        // moved here since 2.3
        add_theme_support( 'woocommerce' );
        
        add_theme_support( 'product_grid', array(
            'min_columns' => 2,
            'max_columns' => 6,
        ) );
    
        // supports slider by default
        add_theme_support( 'wc-product-gallery-slider' );
        
        if ( 'false' !== get_option( 'withemes_woocommerce_lightbox', 'true' ) ) {
            add_theme_support( 'wc-product-gallery-lightbox' );
        }
        
        if ( 'true' === get_option( 'withemes_woocommerce_zoom', 'false' ) ) {
            add_theme_support( 'wc-product-gallery-zoom' );
        }
    
    }
    
    /**
     * Quick View Button
     */
    function quickview_btn() {
        
        if ( 'false' !== get_option( 'withemes_product_loop_quick_view', 'true' ) ) {
        
        ?>
            <div class="quick-view">
                <a class="quickview-btn" href="#" title="<?php echo esc_html__( 'Quick View', 'simple-elegant' ); ?>" data-id="<?php echo get_the_ID(); ?>">
                    <span><?php echo esc_html__( 'Quick', 'simple-elegant' ); ?></span>
                    <span><?php echo esc_html__( 'View', 'simple-elegant' ); ?></span>
                </a>
            </div>

            <span class="quick-view-loading"></span>
<?php
        } // enabled
    }
    
    // add quick view div to footer
    function quick_view() {
    
        echo '<div id="quick-view" class="mfp-hide white-popup-block woocommerce"></div>';
        
    }
    
    function content_product_thumbnail_open_overlay() {
        
        echo '<span class="thumb-overlay"></span>';
    
    }
    
    function content_product_thumbnail_open() {
    
        echo '<div class="product-thumbnail"><div class="product-thumbnail-inner">';
        
    }
    
    function content_product_thumbnail_close() {
        
        echo '</div></div>';
        
    }
    
    function wishlist_button() {
        
        if ( ! class_exists( 'YITH_WCWL_Shortcode' ) ) {
            return;
        }
        
        if ( 'false' !== get_option( 'withemes_product_loop_wishlist', 'true' ) )
        
        echo YITH_WCWL_Shortcode::add_to_wishlist( array(), '' );
    
    }
    
    function wishlist_ajax_update_count() {
        
        if( defined( 'YITH_WCWL' ) && function_exists( 'yith_wcwl_count_all_products' ) ) {
            
            wp_send_json( array(
                'count' => yith_wcwl_count_all_products()
            ) );
            
        }
        
    }
    
    // add wishlist to items
    function wishlist_myaccount_nav_link() {
        
        if ( defined( 'YITH_WCWL' ) ) {
            
            $name = '';
            $page_id = get_option( 'yith_wcwl_wishlist_page_id' );
            if ( $page_id ) $name = get_the_title( $page_id );
            if ( ! $name ) $name = esc_html__( 'My wishlist', 'simple-elegant' );
            
            ?>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--wishlist <?php if ( is_page( $page_id ) ) echo 'is-active'; ?>">
                
				<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>"><?php echo esc_html( $name ); ?></a>
			
            </li>
            <?php
            
        }
        
    }
    
    function myaccount_nav_to_wishlist_page() {
        
        if ( is_user_logged_in() )
        do_action( 'woocommerce_account_navigation' );
        
    }
    
    function product_class( $classes ) {
        
        if ( get_post_type() === 'product' ) {
            
            // Wishlist class
            if ( defined( 'YITH_WCWL' ) ) {
                $classes[] = 'has-wishlist-icon';   
            }
            
        }
        
        return $classes;
    
    }
    
    function content_product_cats() {
        
        if ( 'false' !== get_option( 'withemes_product_loop_categories', 'true' ) )
            
        echo '<div class="product-cats">' . get_the_term_list( get_the_ID(), 'product_cat' ) . '</div>';
        
    }
    
    function content_product_title() {
        
        if ( 'false' !== get_option( 'withemes_product_loop_title', 'true' ) )
        
        echo '<h2 class="product-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
        
    }
    
    /**
     * Wrapper start
     *
     * @since 1.3
     */
    function wrapper_start() {
        
        echo '<div id="wapper-before-content"><div class="container">';
    
    }
    
    /**
     * Wrapper End
     *
     * @since 1.3
     */
    function wrapper_end() {
        
        echo '</div></div>';
    
    }
    
    /**
     * Secondary Thumbnail
     *
     * @since 2.3
     */
    public function woocommerce_template_loop_second_product_thumbnail() {
        
        if ( 'false' === get_option( 'withemes_product_loop_secondary_image', 'true' ) ) return;
        
        global $product, $woocommerce;

        $attachment_ids = $product->get_gallery_image_ids();

        if ( $attachment_ids ) {
            
            $attachment_ids     = array_values( $attachment_ids );
            $secondary_image_id = $attachment_ids['0'];

            $secondary_image_alt = get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
            $secondary_image_title = get_the_title($secondary_image_id);

            echo wp_get_attachment_image(
                $secondary_image_id,
                'woocommerce_thumbnail',
                '',
                array(
                    'class' => 'secondary-image attachment-shop-catalog wp-post-image wp-post-image--secondary',
                    'alt' => $secondary_image_alt,
                    'title' => $secondary_image_title
                )
            );
            
        }
        
    }
    
    /**
     * Single Product Image HTML
     *
     * We just wanna remove zoom class to replace it by iLightbox class
     *
     * @since 1.3
     * @deprecated since 2.3
     *
    function single_product_image_html( $html, $post_id ) {
        
        global $post;
        
        $attachment_id    = get_post_thumbnail_id();
        $props            = wc_get_product_attachment_props( $attachment_id, $post );
        $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
            'title'	 => $props['title'],
            'alt'    => $props['alt'],
        ) );
        
        // lightbox options
        $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
        $full_src = wp_get_attachment_image_src( $attachment_id, 'full' );
        $image_options = 'thumbnail:\'' . $thumbnail_src[0] . '\', width: ' . $full_src[1] . ', height:' . $full_src[2];
        
        $html = sprintf( 
            '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s" data-options="%s">%s</a>', 
            $props['url'], 
            $props['caption'],
            $image_options,
            $image 
        );
        
        return $html;
    
    }
    
    /**
     * Single Thumbnails HTML
     *
     * We just wanna remove zoom class to replace it by iLightbox class
     *
     * @since 1.3
     * @deprecated since 2.3
     * Edited to compatible with WooCommerce 2.3
     *
    function single_product_image_thumbnail_html( $html, $attachment_id ) {
        
        $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
        $full_src = wp_get_attachment_image_src( $attachment_id, 'full' );
        
        // lightbox options
        $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$image_title     = get_post_field( 'post_excerpt', $attachment_id );
        
        $attributes = array(
            'title'                   => $image_title,
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);
        
        $image_options = 'thumbnail:\'' . $thumbnail_src[0] . '\', width: ' . $full_src[1] . ', height:' . $full_src[2];
        
        $html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="lightbox-link" data-options="' . $image_options . '">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
 		$html .= '</a></div>';
        
        return $html;
    
    }
    
    /**
     * Custom number of products per page
     *
     * @since 2.0
     */
    function products_per_page( $ppp ) {
        
        $custom_ppp = absint( get_option( 'withemes_products_per_page' ) );
        if ( $custom_ppp > 0 ) return $custom_ppp;
        return $ppp;
        
    }
    
    /**
     * Custom shop column
     *
     * @since 2.0
     */
    function loop_columns() {
        
        $column = '';
        if ( is_product_taxonomy() ) {
            $column = get_option( 'withemes_shop_tax_column' );
        }
        if ( ! $column ) {
            $column = get_option( 'withemes_shop_column' );
        }
        
        if ( '2' != $column && '3' != $column ) $column = '4';
		return absint( $column );
        
	}
    
    function related_args( $args ) {
        
        $args[ 'columns' ] = $this->loop_columns();
        $args[ 'posts_per_page' ] = $args[ 'columns' ];
        return $args;
        
    }
    
    function upsell_args( $args ) {
        
        $args[ 'columns' ] = $this->loop_columns();
        $args[ 'posts_per_page' ] = $args[ 'columns' ];
        return $args;
        
    }
    
    /**
     * Panels
     *
     * @since 2.0
     */
    function panels( $panels ) {
        
        // $panels[ 'woocommerce' ] = esc_html__( 'WooCommerce', 'simple-elegant' );
        
        return $panels;
    
    }
    
    /**
     * Sections
     *
     * @since 2.0
     */
    function sections( $sections ) {
        
        $sections[ 'woocommerce_archive' ] = array(
            'title' => esc_html__( 'Archive', 'simple-elegant' ),
            'priority' => 1,
            'panel' => 'woocommerce',
            'panel_prefix' => false
        );
        
        $sections[ 'woocommerce_single' ] = array(
            'title' => esc_html__( 'Single Product', 'simple-elegant' ),
            'priority' => 4,
            'panel' => 'woocommerce',
            'panel_prefix' => false
        );
        
        $sections[ 'woocommerce_cart' ] = array(
            'title' => esc_html__( 'Cart', 'simple-elegant' ),
            'priority' => 7,
            'panel' => 'woocommerce',
            'panel_prefix' => false
        );
        
        // Style WooCommerce
        $sections[ 'woocommerce_style' ] = array(
            'title' => esc_html__( 'WooCommerce', 'simple-elegant' ),
            'panel' => 'style',
        );
        
        return $sections;
    
    }
    
    /**
     * Options
     *
     * @since 2.0
     */
    function options( $options ) {
        
        include 'woocommerce.options.php';
        return $options;
        
        $options[ 'products_per_page' ] = array(
            'name' => esc_html__( 'Custom number of products per page', 'simple-elegant' ),
            'type' => 'text',
            
            'panel' => 'woocommerce',
            'panel_prefix' => false,
            'section' => '',
        );
        
        $options[ 'shop_column' ] = array(
            'name' => esc_html__( 'Default Catalog Column Layout', 'simple-elegant' ),
            'type' => 'radio',
            'options' => array(
                '2' => esc_html__( '2 Columns', 'simple-elegant' ),
                '3' => esc_html__( '3 Columns', 'simple-elegant' ),
                '4' => esc_html__( '4 Columns', 'simple-elegant' ),
            ),
            'std' => '4',
            
            'panel' => 'woocommerce',
            'panel_prefix' => false,
        );
        
        $options[ 'header_cart' ] = array(
            'name' => esc_html__( 'Show header cart?', 'simple-elegant' ),
            'type' => 'radio',
            'options' => withemes_enable_options(),
            'std' => 'true',
            
            'panel' => 'woocommerce',
            'panel_prefix' => false,
        );
        
        return $options;
    
    }
    
    /**
     * Add column to body class
     *
     * @since 2.0
     */
    function body_class( $classes ) {
    
        if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            
            $column = get_option( 'withemes_shop_column' );
            if ( '2' != $column && '3' != $column ) $column = '4';
            $classes[] = 'columns-' . $column;
            
        }
        
        $item_spacing = get_option( 'withemes_product_loop_item_spacing', 'small' );
        if ( 'large' !== $item_spacing ) $item_spacing = 'small';
        $classes[] = 'catalog-item-spacing-' . $item_spacing;
        
        return $classes;
        
    }
    
    /**
     * Register Shop Sidebar
     * @since 2.3
     */
    function widgets_init() {
        
        register_sidebar( array(
            'name'          => esc_html__( 'Shop Sidebar', 'simple-elegant' ),
            'id'            => 'shop',
            'description'   => esc_html__( 'Add widgets here to appear in the sidebar of WooCommerce pages.', 'simple-elegant' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    
    }
    
    /**
     * Use Prev/Next for WooCommerce Pagination
     * @since 2.3
     */
    function woocommerce_pagination_args( $args ) {
        
        $args[ 'prev_text' ] = esc_html__( 'Previous', 'simple-elegant' );
        $args[ 'next_text' ] = esc_html__( 'Next', 'simple-elegant' );
        
        return $args;
    
    }
    
    /**
     * Product preview ajax (Quick View)
     *
     * @since 2.3
     */
    function product_preview() {
        
        $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
    
        // Verify nonce field passed from javascript code
        if ( ! wp_verify_nonce( $nonce, 'preview_nonce' ) )
            die ( 'Busted!');

        $id = isset( $_POST[ 'id' ] ) ? absint( $_POST[ 'id' ] ) : '';
        if ( ! $id ) exit();
        
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true,
            'p' => $id,
        );
        
        $query = new WP_Query( $args );
        if ( ! $query->have_posts() ) {
            wp_reset_query();
            exit();
        }
        while( $query->have_posts() ) {
            $query->the_post();
            
            if ( post_password_required() ) {
                echo get_the_password_form(); // WPCS: XSS ok.
                return;
            }
            
        ?>

        <div <?php post_class( 'product product-preview' ); ?> id="product-preview-<?php echo absint( $id ); ?>">

            <?php
                    ob_start();
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action( 'woocommerce_before_single_product_summary' );

                    $image_without_link = ob_get_clean();
                    echo strip_tags( $image_without_link, '<div><figure><img><span><script><style>' );

            ?>

            <div class="summary entry-summary">

                <?php

                    /**
                     * Hook: woocommerce_preview_product_summary.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     */
                    do_action( 'woocommerce_preview_product_summary' );
                ?>

            </div>

        </div><!-- .product-preview -->

    <?php
        }
        wp_reset_query();
        exit();
    }
    
    /**
     * single product title
     */
    function single_title() {
        
        withemes_shop_title( 'old' );
        
    }
    
    function woocommerce_product_thumbnails_columns( $columns ) {
        
        return 6;
        
    }
    
    /**
     * Opening div for upper single product part
     */
    function single_div_open() {
        echo '<div class="single-product-upper" id="single-product-upper">';
    }
    function single_div_close() {
        echo '</div><!-- .single-product-upper -->';
    }
    
    /**
     * building an offcanvas cart
     */
    function cart_offcanvas() {
        ?>

<div id="cart-offcanvas" class="woocommerce">
    
    <a href="#" rel="nofollow" class="cart-offcanvas-close">&times;</a>
    
    <div class="added-success">
            
        <span><?php echo esc_html__( 'Product added to cart', 'simple-elegant' ); ?></span>
        <i class="fa fa-check-circle"></i>

    </div><!-- .added-success -->
    
    <div id="cart-offcanvas-inner" class="widget_shopping_cart">
        
        <?php woocommerce_mini_cart(); ?>
    
    </div><!-- #cart-offcanvas-inner -->

</div><!-- #cart-offcanvas -->

<div id="cart-offcanvas-overlay"></div>

        <?php
    }
    
    function offcanvas_add_to_cart_fragment( $fragments ) {
        
        global $woocommerce;
        
        ob_start();
        echo '<div id="cart-offcanvas-inner" class="widget_shopping_cart">';
        woocommerce_mini_cart();
        echo '</div><!-- #cart-offcanvas-inner -->';
        $fragments[ '#cart-offcanvas-inner' ] = ob_get_clean();

        return $fragments;
        
    }
    
}

Withemes_WooCommerce::instance()->init();

endif;

if ( ! function_exists( 'withemes_shop_title' ) ) :
/**
 * Shop title
 *
 * @since 2.3
 */
function withemes_shop_title( $old_or_new = 'old' ) {

    if ( $old_or_new !== get_option( 'withemes_page_title_style', 'new' ) ) return;
    
    if ( is_shop() ) {
        
        $pageid = get_option( 'woocommerce_shop_page_id' );
        if ( 'true' === get_post_meta( $pageid, '_withemes_disable_title', true ) ) return;
        
    } elseif ( ! is_product_taxonomy() ) {
        
        return;
    
    }

    if ( 'old' === $old_or_new ) { ?>
        
        <h1 id="page-title" class="page-title" itemprop="headline">
            
            <?php woocommerce_page_title(); ?>
            
        </h1>
        
    <?php } else { ?>
    
        <div id="titlebar">
    
            <div class="container">

                <h1 id="titlebar-title" itemprop="headline"><?php woocommerce_page_title(); ?></h1>

            </div><!-- .container -->

        </div><!-- #titlebar -->

    <?php }
    
}

endif;

add_filter( 'add_to_cart_fragments', 'withemes_header_add_to_cart_fragment' );
/**
 * Update header cart on ajax adding to cart
 * @since 2.3
 */
function withemes_header_add_to_cart_fragment( $fragments ) {
    
    ob_start();
    
    withemes_header_cart();
    
    $fragments[ '#wi-mainnav #header-cart' ] = ob_get_clean();
    return $fragments;
    
}

if ( ! function_exists( 'withemes_header_cart' ) ) :
/**
 * Header Cart
 * @since 2.3
 */
function withemes_header_cart() {
    
    global $woocommerce;
    $cart_class = 'cart-current-empty';
    $count = $woocommerce->cart->get_cart_contents_count(); if ( $count > 0 ) { $cart_class = 'cart-active'; }
    
    if ( $count > 0 ) {
        $title = sprintf( esc_html__( 'Total: %s', 'simple-elegant' ), strip_tags( $woocommerce->cart->get_cart_total() ) );
    } else {
        $title = esc_html__( 'Your cart is empty', 'simple-elegant' );
    }
    ?>

    <div class="<?php echo $cart_class; ?>" id="header-cart">

        <a href="<?php echo wc_get_cart_url(); ?>" class="has-tip" title="<?php echo esc_attr( $title ); ?>">

            <i class="bi_ecommerce-shopcart"></i>
            <span class="items-number"><?php echo $count; ?></span>

        </a>

    </div><!-- #header-cart -->

    <?php

}
endif;

if ( ! function_exists( 'withemes_header_commerce' ) ) :
/**
 * Header Commerce
 * @since 2.3
 *
 * include wishlist & cart
 */
function withemes_header_commerce() {
    
    if ( ! class_exists( 'WooCommerce' ) || 'false' === get_option( 'withemes_header_cart' ) ) return;

?>

<div id="header-commerce" class="header-cart">
    
    <?php if( defined( 'YITH_WCWL' ) && class_exists( 'YITH_WCWL' ) && function_exists( 'yith_wcwl_count_all_products' ) ) { ?>
    <div id="header-wishlist" class="header-wishlist">
        <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" title="<?php echo esc_html( 'My wishlist', 'simple-elegant' ); ?>" class="wi-wishlist-url has-tip">
            <i class="icon-star"></i>
            <span class="item-counter"><?php echo yith_wcwl_count_all_products(); ?></span>
        </a>
    </div>
    <?php } ?>
    
    <?php withemes_header_cart(); ?>
    
</div><!-- #header-commerce .header-cart -->
    <?php
}
endif;

if ( ! function_exists( 'withemes_topbar_myaccount' ) ) :
/**
 * Topbar My Account
 * @since 2.3
 */
function withemes_topbar_myaccount() {
    
    if ( ! class_exists( 'WooCommerce' ) || 'false' === get_option( 'withemes_topbar_myaccount', 'true' ) ) return;

    if ( is_user_logged_in() ) {
        
        $current_user = wp_get_current_user(); ?>

    <div id="topbar-myaccount">

        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php echo esc_html__( 'My Account','simple-elegant' ); ?>">

            <span class="avatar">
                <?php echo get_avatar( $current_user->user_email, apply_filters( 'withemes_woocommerce_avatar_size', 120 ) ); ?>
            </span>

            <span class="name">
                <?php echo $current_user->display_name; ?>
            </span>

        </a>

    </div><!-- #topbar-myaccount -->

    <?php } else { ?>

    <div id="topbar-myaccount">

        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
            <?php echo esc_html__( 'Login', 'simple-elegant' ) ; ?>
            <i class="fa fa-lock"></i>
        </a>

    </div><!-- #topbar-myaccount -->

    <?php } // if user logged in

}
endif;