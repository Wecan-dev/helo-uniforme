<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Simple & Elegant
 * @since 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
    
    <div id="wi-wrapper">
        
        <header id="wi-header" class="<?php echo esc_attr( withemes_header_class() ); ?>" itemscope itemtype="https://schema.org/WPHeader">
            
            <?php if ( withemes_topbar_enabled() ) : ?>
            
            <div id="wi-topbar" class="wi-topbar">
                <div class="container">
                    <div class="topbar-left">
                        
                        <?php /* -------------------- Topbar Menu -------------------- */ ?>
                        <?php if ( has_nav_menu('topbar') ) : ?>
                            
                        <nav id="topbarnav" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                            <?php wp_nav_menu(array(
                                'theme_location'	=>	'topbar',
                                'depth'				=>	2,
                                'container_class'	=>	'menu',
                            ));?>
                        </nav><!-- #topbarnav -->
                        
                        <?php endif; ?>
                        
                        <?php if ( $topbar_text = get_option( 'withemes_topbar_text' ) ) { ?>
                        
                        <p class="topbar-text"><?php echo $topbar_text; ?></p>
                        
                        <?php } ?>
                        
                    </div><!-- .topbar-left -->
                    <div class="topbar-right">
                        
                        <?php /* -------------------- Social -------------------- */?>
                        <?php if ( 'false' != get_option('withemes_topbar_social') ): ?>
                        <?php echo withemes_display_social(); ?>
                        <?php endif; ?>
                        
                        <?php /* -------------------- Search -------------------- */?>
                        <?php if ( 'false' != get_option('withemes_topbar_search') ): ?>
                        <?php get_search_form(); ?>
                        <?php endif; ?>
                        
                        <?php withemes_topbar_myaccount(); ?>
                        
                    </div><!-- .topbar-right -->
                    
                </div><!-- .container -->
            </div><!-- #wi-topbar -->
            
            <?php endif; // topbar enabled ?>
            
            <div id="logo-area">
                <div class="container">
                    
                    <a id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    
                    <?php /* -------------------- Logo -------------------- */?>
                    
                    <?php withemes_logo(); ?>
                    
                    <?php $layout = get_option( 'withemes_header_layout' );
                        if ( '2' == $layout ) { ?>
                    
                    <div class="header-right">
                        
                        <?php $header_text = trim( get_option( 'withemes_header_text' ) );
                            if ( $header_text ) {
                                echo '<div class="header-text">' . wp_kses( $header_text, withemes_allowed_html() ) . '</div>';
                            }
                        ?>
                        <?php /* -------------------- Social -------------------- */?>
                        <?php if ( 'true' == get_option('withemes_header_social') ): ?>
                        <?php echo withemes_display_social(); ?>
                        <?php endif; ?>
                        
                        </div><!-- .header-right -->
                    
                    <?php } // layout 2 ?>
                    
                </div><!-- .container -->
            </div><!-- #logo-area -->
            
            <?php /* -------------------- Primary Menu -------------------- */?>
            <?php if ( has_nav_menu('primary') ) : ?>
            
            <?php
                $nav_class = array( 'wi-mainnav' );
                $mainnav_border_length = get_option( 'withemes_mainnav_border_length', 'container' );
                if ( 'fullwidth' != $mainnav_border_length ) $mainnav_border_length = 'container';
                $nav_class[] = 'mainnav-border-' . $mainnav_border_length;

                if ( '' !== get_option( 'withemes_mainnav_background' ) ) $nav_class[] = 'custom-background';

                $nav_class = join( ' ', $nav_class );
            ?>
            
            <nav id="wi-mainnav" class="<?php echo esc_html__( $nav_class ); ?>" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                
                <div class="container">
                    
                    <?php wp_nav_menu(array(
                        'theme_location'	=>	'primary',
                        'depth'				=>	3,
                        'container_class'	=>	'menu',
                    ));?>
                    
                    <?php withemes_header_commerce(); ?>
                    
                </div><!-- .container -->
                
            </nav><!-- #wi-mainnav -->
            
            <div id="mainnav-height"></div>
            
            <?php endif; ?>
            
        </header><!-- #wi-header -->
        
        <main id="wi-main">