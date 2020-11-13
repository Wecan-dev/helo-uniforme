<?php
/**
 * The template for displaying WooCommerce pages according to their documentation
 * https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Simple & Elegant
 *
 * @since Simple & Elegant 1.3
 * @modified in 2.3
 */

get_header(); ?>

<?php withemes_shop_title( 'new' ); ?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<div id="page-wrapper">
    
    <div class="container">
        
        <div id="primary">

            <?php woocommerce_content(); ?>

        </div><!-- #primary -->

        <?php
        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' ); ?>

    </div><!-- .container -->
    
</div><!-- #page-wrapper -->

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>
    
<?php get_footer();