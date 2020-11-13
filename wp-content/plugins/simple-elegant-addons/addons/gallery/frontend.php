<?php

// IMAGE SOURCE
$source = 'media'; // since 2.5.1, forget the instagram

$class = array( 'wi-gallery' );

$images = explode ( ',', $images );
$images = array_map( 'trim', $images );
if ( empty( $images ) ) return;

// Layout
if ( 'media' === $source ) {
    if ( 'metro' !== $layout ) $layout = 'grid';
    $class[] = 'gallery-' . $layout;
}

// Column
if ( 'grid' === $layout ) {
    
    $column = absint( $column );
    if ( $column < 1 || $column > 8 ) $column = 3;
    $class[] = 'column-' . $column;
    
}

// Thumbnail Ratio
if ( 'metro' === $layout ) {
    $ratio = 0;
    $thumb_ratio = explode( ':', $thumb_ratio );
    $w = isset( $thumb_ratio[0] ) ? $thumb_ratio[0] : 0; $w = intval( $w );
    $h = isset( $thumb_ratio[1] ) ? $thumb_ratio[1] : 0; $h = intval( $h );
    if ( $w > 0 && $h > 0 ) {
        $ratio = $h/$w * 100;
    }
    if ( $ratio < 16.66 || $ratio > 400 ) $ratio = 100; // default value
    $height_css = '';
    if ( $ratio !== 100 ) {
        $height_css = ' style="padding-bottom:' . $ratio . '%"';
    }
}

// Lightbox
if ( 'true' == $lightbox ) $class[] = 'wi-lightbox-gallery';

// CSS
$wrapper_style = $item_style = '';
if ( is_numeric( $item_spacing ) && $item_spacing >= 0 ) {
    $pad = $item_spacing/2;
    $wrapper_style = ' style="margin:-' . $pad . 'px;"';
    $item_style = ' style="padding:' . $pad . 'px;"';
}

// Render
$class = join( ' ', $class );
?>

<div class="<?php echo esc_attr( $class );?>"<?php echo $wrapper_style; ?>>

    <?php 
// MEDIA LIBRARY
// ====================
if ( 'media' === $source ) :

$attachments = get_posts( array(
    'posts_per_page' => -1,
    'orderby' => 'post__in',
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'post__in' => $images,
) );

$count = 0;

foreach ( $attachments as $attachment ) :

if ( 'true' == $lightbox ) {
    
    $title = trim( $attachment->post_title );
    $img_caption = trim( $attachment->post_excerpt );
    
    // attr array
    $attr = array();
    
    $fullsize = wp_get_attachment_image_src( $attachment->ID, 'full' );
    
    if ( $img_caption ) {
        $attr[] = 'title="' . esc_attr( $img_caption ) . '"';
    }
    
    $attr = join( ' ', $attr );
    
    $open = '<a href="' . esc_url( $fullsize[0] ) . '" ' . $attr . ' class="lightbox-link">';
    
    $close = '</a>';
    
} else {
    $open = $close = '';
}

    ?>

    <div class="gal-item"<?php echo $item_style; ?>>
        
        <div class="gal-item-wrapper">
        
            <figure class="gal-item-inner">

                <?php echo $open; ?>
                
                <?php
                /* ------------     GRID LAYOUT     ---------- */
                if ( 'grid' === $layout ) {

                    if ( ! $thumb ) {
                        $thumb = 'wi-square';
                    }

                    if ( function_exists( 'wpb_getImageBySize' ) ) {

                        $img = wpb_getImageBySize( array(
                            'attach_id' => $attachment->ID,
                            'thumb_size' => $thumb,
                            'class' => 'image-fadein',
                        ) );

                        $img = $img[ 'thumbnail' ];

                    } else {

                        $img = wp_get_attachment_image( $attachment->ID, $thumb, false, array( 'class' => 'image-fadein' ) );

                    }
                    ?>

                    <?php echo $img;
                    
                /* ------------     METRO LAYOUT     ---------- */    
                } else {
                    
                    $count++;
                    if ( $count % 6 === 1 || $count %6 === 4 ) {
                        $thumb_size = 'full';
                    } else {
                        $thumb_size = 'large';
                    }
                    $bg = wp_get_attachment_image_src( $attachment->ID, $thumb_size );
                    
                    ?>
                
                <div class="bg_thumb">
                    
                    <div class="bg_element" style="background-image:url(<?php echo esc_url( $bg[0] ); ?>)"></div>
                    
                    <div class="height_element"<?php echo $height_css; ?>></div>
                
                </div><!-- .bg_thumb -->
                    
                    <?php
                } // which $layout ?>
                
                <?php echo $close; ?>
                
                <?php if ( ( 'true' === $caption ) && ( trim( $attachment->post_excerpt ) ) ) { ?>
            
                <figcaption class="gallery-item-caption"><?php echo trim( $attachment->post_excerpt ); ?></figcaption>

                <?php } // caption ?>

            </figure>
            
        </div>

    </div><!-- .gal-item -->

<?php endforeach; // attachments ?>
    
<?php    
// INSTAGRAM
// ====================
elseif ( function_exists( 'withemes_get_instagram_photos' ) ) : $photos = withemes_get_instagram_photos( $access_token, $number, $cache_time );
if ( $photos && is_array( $photos ) ) :

foreach ( $photos as $photo )  :

if ( 'true' == $lightbox ) {
    
    $title = $photo[ 'description' ];
    
    // attr array
    $attr = array();
    
    $full_src = '';
    if ( $photo[ 'large' ] ) $full_src = $photo[ 'large' ];
    elseif ( $photo[ 'medium' ] ) $full_src = $photo[ 'medium' ];
    elseif ( $photo[ 'thumbnail' ] ) $full_src = $photo[ 'thumbnail' ];
    
    if ( $title ) {
        $attr[] = 'title="' . esc_attr( $title ) . '"';
    }
    
    $attr = join( ' ', $attr );
    
    $open = '<a href="' . esc_url( $full_src ) . '" ' . $attr . ' class="lightbox-link">';
    $close = '</a>';
    
} else {
    
    if ( isset( $photo[ 'link' ] ) ) {
        $open = '<a href="' . esc_url( $photo[ 'link' ] ) . '" target="_blank" title="' . esc_attr( $photo[ 'description' ] ). '">';
        $close = '</a>';
    } else {
        $open = $close = '';
    }
}

// SRC
$src = '';
if ( 'large' != $instagram_size && 'thumbnail' != $instagram_size ) $instagram_size = 'medium';
if ( 'large' == $instagram_size ) {
    $src = $photo[ 'large' ];
}
if ( 'medium' == $instagram_size || ( 'large' == $instagram_size && ! $src ) ) {
    $src = $photo[ 'medium' ];
}
if ( 'thumbnail' == $instagram_size || ( 'medium' == $instagram_size && ! $src ) || ( 'large' == $instagram_size && ! $src ) ) {
    $src = $photo[ 'thumbnail' ];
}
if ( ! $src ) $src = $photo[ 'thumbnail' ];
if ( ! $src ) continue;

    ?>

    <div class="gal-item"<?php echo $item_style; ?>>
        
        <div class="gal-item-wrapper">
        
            <figure class="gal-item-inner">

                <?php echo $open . '<img src="' . esc_url( $src ). '" alt="' . esc_attr( $photo[ 'description' ] ) . '" />' . $close ; ?>

            </figure>
            
        </div>

    </div><!-- .gal-item -->

<?php endforeach; // photos
    
endif;
endif;

// END IF IMAGE SOURCE
// ====================
?>
    
</div>