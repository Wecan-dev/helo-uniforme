<?php
// form ID is mandatory
if ( ! $form ) return;

$class = array( 'wi-mailchimp-form' );

// layout
if ( 'inline' != $layout ) $layout = 'stack';
$class[] = 'mailchimp-form-' . $layout;

$color_css = '';
if ( $color ) {
    $class[] = 'custom-color';
    $color_css = ' style="color:' . esc_attr( $color ) . '"';
}

// align
if ( 'left' != $align && 'right' != $align ) $align = 'center';
$class[] = 'form-align-' . $align;

// size
if ( 'big' !== $input_size ) $input_size = 'normal';
$class[] = 'input-size-' . $input_size;

$class = join( ' ', $class );

// css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $inner_css, ' ' ), 'mailchimp_form', $atts );
?>
<div class="<?php echo esc_attr( $class ); ?>"<?php echo $color_css; ?>>
    
    <div class="mailchimp-form-inner">
        
        <div class="mailchimp-form-markup <?php echo esc_attr( $css_class ); ?>">
            
            <?php 
            if ( function_exists( 'wpb_widget_title' ) ) {
                echo wpb_widget_title( array(
                    'title' => $title,
                    'extraclass' => 'wpb_mailchimp_heading',
                ) );
            } ?>

            <?php if ( $description ) : ?>

            <div class="form-description">
                <?php echo do_shortcode( wpautop( $description ) ); ?>
            </div>

            <?php endif; ?>
    
            <?php echo do_shortcode( '[mc4wp_form id="' . esc_attr( $form ) . '"]' ); ?>
            
        </div>
    
    </div><!-- .mailchimp-form-inner -->
    
</div>