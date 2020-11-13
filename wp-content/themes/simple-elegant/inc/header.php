<?php
if ( ! function_exists( 'withemes_header_class' ) ):
/**
 * Header CSS Class
 *
 * @since 2.0
 */
function withemes_header_class() {
    
    $classes = array( 'wi-header' );
    
    $layout = get_option( 'withemes_header_layout', '1' );
    if ( '2' != $layout ) $layout = '1';
    
    $classes[] = 'header-' . $layout;
    
    $classes = apply_filters( 'withemes_header_class', $classes );
    
    return join( ' ', $classes );

}
endif;

if ( ! function_exists( 'withemes_topbar_enabled' ) ):
/**
 * Check if topbar enabled/displayed or not
 *
 * @since 2.3
 */
function withemes_topbar_enabled() {
    
    if ( 'false' === get_option('withemes_enable_topbar' ) ) return false;
    
    if ( is_singular() ) {
        if ( 'true' === get_post_meta( get_the_ID(), '_withemes_disable_topbar', true ) ) return false;
    }
    
    return true;
    
}
endif;

if ( ! function_exists( 'withemes_is_header_transparent' ) ):
/**
 * Verify that header transparent displayed on this page
 *
 * @since 2.3
 */
function withemes_is_header_transparent() {
   
    return ( is_singular() ) && 'true' === get_post_meta( get_the_ID(), '_withemes_transparent_header', true );
    
}
endif;

if ( ! function_exists( 'withemes_logo' ) ):
/**
 * Displays site logo
 *
 * @since 2.3
 */
function withemes_logo() {
    
    $heading = 'h2'; if ( is_front_page() || is_home() ) $heading = 'h1'; ?>

<div id="wi-logo">
    <?php echo '<' . $heading . '>'; ?>
    
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            
            <?php
            // get the right logo
            $logo = '';
            if ( withemes_is_header_transparent() ) {
                $logo = get_option( 'withemes_transparent_logo' );
                if ( ! $logo ) {
                    $logo = get_option('withemes_logo');
                }
                if ( ! $logo ) $logo = get_template_directory_uri() . '/images/transparent-logo.png';
            } else {
                $logo = get_option('withemes_logo');
                if ( ! $logo ) $logo = get_template_directory_uri() . '/images/logo.png';
            } ?>
            
            <img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_html_e('Logo','simple-elegant');?>" />
            
        </a>
    
    <?php echo '</' . $heading . '>'; ?>

    <?php /* -------------------- Tagline -------------------- */?>
    <?php if ( 'false' != get_option('withemes_header_tagline')) : ?>
    <h3 id="wi-tagline"><?php echo get_bloginfo( 'description', 'display' );?></h3>
    <?php endif; // disable tagline ?>

</div><!-- #wi-logo -->
<?php

}
endif;