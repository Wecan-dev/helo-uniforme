<?php
$apikey = trim( get_option( 'withemes_google_maps_api_key' ) );
if ( ! $apikey ) {
    echo '<div class="wi-msg">Google Maps API Key is required. Let go to Customize > Miscellaneous to enter Google Maps API Key.</div>';
    return;
}

// marker image
$marker_image = '';
if ( $marker ) $marker_image = wp_get_attachment_url( $marker );
if ( ! $marker_image ) $marker_image = SIMPLE_ELEGANT_ADDONS_URL . 'icons/marker.png'; // default marker

// lat & lng
$options = array(
    'zoom' => $zoom,
    'scrollwheel' => ( 'true' === $scrollwheel ),
    'marker_image' => esc_url( $marker_image ),
    'style' => $style,
    'map_type' => $map_type,
);

$map_args = array();

$controls = explode( ',', $controls );
foreach ( $controls as $control ) {
    $map_args[ $control ] = true;
}

$latlng = $this->get_lat_lng( $address );
if ( ! is_wp_error( $latlng ) && is_array( $latlng ) && isset( $latlng[ 'lat' ] ) && $latlng[ 'lat' ] && isset( $latlng[ 'lng' ] ) && $latlng[ 'lng' ] ) {
    $options[ 'lat' ] = $latlng[ 'lat' ];
    $options[ 'lng' ] = $latlng[ 'lng' ];
} else {
    
    // TODO
    // Prints detailed error
    return;
}

wp_enqueue_script( 'google-maps-api', 'https://maps.google.com/maps/api/js?key=' . $apikey, array(), '4.0', true ); 

// Map Type
$css = '';
$height = absint( $height );
if ( $height > 10 ) {
    $css = ' style="height:'. $height .'px;"';
}
?>

<div class="gmap-wrapper">
    
    <div class="wi-gmap" data-options='<?php echo json_encode( $options ); ?>' data-map_args='<?php echo json_encode($map_args);?>'<?php echo $css;?>></div>
    
</div><!-- .gmap-wrapper -->