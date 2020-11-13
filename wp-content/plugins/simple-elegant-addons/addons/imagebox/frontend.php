<?php
$imagebox_class = array( 'wi-imagebox' );

// Text position
$text_position = explode( '-', $text_position );
foreach ( $text_position as $p ) {
    $imagebox_class[] = 'text-' . $p;
}

// Height CSS
$height_css = '';
if ( $ratio ) {
    $dims = explode( ':', $ratio );
    $w = isset( $dims[0] ) ? absint( $dims[0] ) : 0;
    $h = isset( $dims[1] ) ? absint( $dims[1] ) : 0;
    if ( $h > 0 && $w > 0 ) {
        $height_css = ' style="padding-bottom:' . ( $h/$w ) * 100 . '%;"';
    }
}

// Overlay
$overlay_css = '';
if ( $overlay ) {
    $overlay_css = ' style="background-color:' . esc_attr( $overlay ) . '"';
}

// Link
$link = vc_build_link( $link );
$link[ 'url' ] = trim( $link[ 'url' ] );
if ( $link[ 'url' ] ) $imagebox_class[] = 'has-link';
$target = ( trim($link[ 'target' ]) == '_blank' ) ? '_blank' : '_self';

// Button
$buttonClass = new Withemes_Button();
$button_rendered = $buttonClass->shortcode( $atts );

// Render Image/Images HTML
$image = trim( $image );
$photos = explode( ',', $image );
$photos = array_map( 'trim', $photos );
$attachments = get_posts( array(
    'posts_per_page' => -1,
    'orderby' => 'post__in',
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'post__in' => $photos,
) );

// a background slideshow
$image_html = '';
if ( count( $attachments ) > 1 ) {
    
    $options = array(
        'animation' => 'fade',
        'controlNav' => true,
        'directionNav' => false,
        'slideshow' =>  true,
        'slideshowSpeed' => 5000,
        'smoothHeight' => false,
        'pauseOnAction' => false,
        'pauseOnHover' => false,
        'keyboard' => false,
    );
    
    $image_html = '<div class="imagebox-slider wi-flexslider" data-options=\'' . json_encode( $options ) . '\'>';
    $image_html .= '<div class="flexslider">';
    $image_html .= '<ul class="slides">';
    
    foreach ( $attachments as $attachment ) {
    
        $image_html .= '<li class="slide">';
        $image_html .= '<div class="bg-thumb">';
        $image_html .= '<div class="bg-element" style="background-image:url(' . wp_get_attachment_url( $attachment->ID ) . ')"></div>';
        $image_html .= '<div class="imagebox-overlay"' . $overlay_css . '></div>';
        $image_html .= '</div><!-- .bg-thumb -->';
        
        $image_html .= '<div class="height-element"' . $height_css . '></div>';
        
        if ( ! $button_rendered && $link[ 'url' ] ) {
            $image_html .= '<a href="' . esc_url( $link[ 'url' ] ) . '" target="' . esc_attr( $target ) . '" class="wrap-link"></a>';
        }
        
        $image_html .= '</li>';
    
    }
    
    $image_html .= '</ul></div>'; // flexslider
    $image_html .= '</div>'; // .imagebox-slider
    

} elseif ( count( $attachments ) === 1 ) {
    
    $attachment = $attachments[0];
    
    $image_html = '<div class="bg-thumb">';
    $image_html .= '<div class="bg-element" style="background-image:url(' . wp_get_attachment_url( $attachment->ID ) . ')"></div>';
    $image_html .= '<div class="imagebox-overlay"' . $overlay_css . '></div>';
    
    if ( ! $button_rendered && $link[ 'url' ] ) {
        $image_html .= '<a href="' . esc_url( $link[ 'url' ] ) . '" target="' . esc_attr( $target ) . '" class="wrap-link"></a>';
    }
    
    $image_html .= '</div><!-- .bg-thumb -->';
    
} else {

    $image_html = '<div class="bg-thumb"></div>';

}

// Title CSS
$title_css = '';
if ( $text_color ) $title_css = ' style="color:' . esc_attr( $text_color ) . '"';

/**
 * Render
 */
$imagebox_class = join(' ',$imagebox_class);
?>

<div class="<?php echo esc_attr( $imagebox_class ); ?>">
    
    <div class="imagebox-inner">
        
        <div class="imagebox-inner-inner">
        
            <?php echo $image_html; ?>

            <?php if ( $title || $subtitle ) : ?>
            <div class="imagebox-text"<?php echo $title_css; ?>>

                <?php if ( $title ) { ?>

                <div class="imagebox-title-wrapper">
                    <h2 class="imagebox-title"><?php echo esc_html( $title ); ?></h2>
                </div>

                <?php } ?>

                <?php if ( $subtitle ) { ?>

                <div class="imagebox-subtitle-wrapper">
                    <h3 class="imagebox-subtitle"><?php echo esc_html( $subtitle ); ?></h3>
                </div>

                <?php } ?>

                <?php if ( $button_rendered ) { ?>

                <div class="imagebox-button-wrapper">
                    <?php echo $button_rendered; ?>
                </div>

                <?php } ?>

            </div><!-- .imagebox-text -->
            <?php endif; ?>
            
        </div><!-- .imagebox-inner-inner -->
        
        <div class="height-element"<?php echo $height_css; ?>></div>
    
    </div><!-- .imagebox-inner -->
    
</div><!-- .wi-imagebox -->