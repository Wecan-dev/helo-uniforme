<?php
$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
$classes = array( 'pricing-column' );

$border_css = $bg_css = '';
if ( 'true' === $featured ) {
    $classes[] = 'column-featured';
    
    if ( $featured_color ) {
        $border_css = ' style="border-color:' . $featured_color . '"';
        $bg_css = ' style="background-color:' . $featured_color . '"';
    }
}

// Button
$buttonClass = new Withemes_Button();
$button_rendered = $buttonClass->shortcode( $atts );

$classes = join( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>"<?php echo $border_css; ?>>
    
    <div class="pricing-column-inner">
        
        <h3 class="pricing-title"<?php echo $bg_css; ?>><?php echo $title; ?></h3>
        
        <?php if ( $image ) { ?>
        
        <figure class="pricing-column-image">
            
            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                             
        </figure>
        
        <?php } ?>
        
        <div class="pricebox">
        
            <div class="wi-price">
                
                <span class="price-unit"><?php echo $price_unit; ?></span>
                <span class="main-price"><?php echo $price; ?></span>
                
            </div><!-- .wi-price -->
            
            <div class="per"><?php echo $per; ?></div>
        
        </div><!-- .pricebox -->
        
        <div class="pricing-features">
        
            <?php echo do_shortcode( $content ); ?>
        
        </div>
        
        <?php if ( $button_rendered ) : ?>
        
        <div class="pricing-cta">
            
            <?php echo $button_rendered; ?>
            
        </div><!-- .pricing-cta -->
        
        <?php endif; ?>
        
    </div><!-- .pricing-content -->
    
</div>