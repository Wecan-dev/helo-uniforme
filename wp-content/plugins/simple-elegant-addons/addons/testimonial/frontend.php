<?php
$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
    
$result = $meta = $rating_html = $footer = '';

$rating = floatval($rating);
if ($rating > 5 || $rating <= 0) $rating = false;

// rating
if ( $rating ) {
    $rating_html = '<div class="rating" title="' . sprintf (__('Rated %d out of 5','simple-elegant'), $rating ) . '">';
    $rating_html .= '<span style="width:' . ($rating *20) . '%">' . sprintf( __('<strong class="">%d</strong> out of 5', 'simple-elegant'), $rating ) . '</span>';
    $rating_html .= '</div>';
}

// meta
if ( $name || $rating_html ) {
    $meta = '<div class="testimonial-meta">';
    $meta .= '<span class="testimonial-name">' . $name . '</span>';
    if ( $from ) {
        $meta .= '<div class="testimonial-from">' . esc_html ($from) . '</div>';
    }
    $meta .= '</div>';
}

$testimonial_img = '';
if ( $image ) {
    $img = wp_get_attachment_image( $image,'thumbnail' );
    if ($img) {
        $testimonial_img = '<figure class="testimonial-avatar">' . $img . '</figure>';
    }
}

if ( $meta || $rating_html || ( 'left' == $align && $testimonial_img ) ) {
    if ( 'left' == $align ) $footer .= $testimonial_img;
    $footer .= '<div class="testimonial-footer-text">' . $rating_html . $meta . '</div>';
}

if ( $footer ) {
    $footer = '<div class="testimonial-footer">' . $footer . '</div>';
}

$result = '<div class="wi-testimonial align-' . esc_attr( $align ) . '">' . ( 'center' == $align ? $testimonial_img : '' ) . '<div class="testimonial-content">' . $content  . '</div>' . $footer . '</div>';

echo $result;