<?php

$numbers = array( '1' => esc_html__( '1 Photo', 'simple-elegant' ) );
for ( $i = 2; $i <= 12; $i++ ) {
    $numbers[ (string) $i ] = sprintf( esc_html__( '%d Photos', 'simple-elegant' ), $i );
}

$columns = array( '1' => esc_html__( '1 Column', 'simple-elegant' ) );
for ( $i = 2; $i <= 9; $i++ ) {
    $columns[ (string) $i ] = sprintf( esc_html__( '%d Columns', 'simple-elegant' ), $i );
}

$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'simple-elegant' ),
        'std' => '',
    ),
    
    array (
        'id' => 'username',
        'type' => 'text',
        'placeholder' => 'yourusername',
        'name' => esc_html__( 'Instagram Username', 'simple-elegant' ),
    ),
    
    array(
        'id' => 'number',
        'type' => 'select',
        'options'=> $numbers,
        'std'   => '6',
        'name' => esc_html__( 'Number of photos', 'simple-elegant' ),
    ),
    
    array(
        'id' => 'column',
        'type' => 'select',
        'options'=> $columns,
        'std'   => '3',
        'name' => esc_html__( 'Columns?', 'simple-elegant' ),
    ),
    
    array(
        'id' => 'size',
        'type' => 'select',
        'options'=> array(
            'thumbnail' => esc_html__( 'Thumbnail', 'simple-elegant' ),
            'medium' => esc_html__( 'Medium', 'simple-elegant' ),
            'large' => esc_html__( 'Large', 'simple-elegant' ),
        ),
        'std'   => 'medium',
        'name' => esc_html__( 'Image Size', 'simple-elegant' ),
    ),
    
    array(
        'id' => 'space',
        'type' => 'text',
        'name' => esc_html__( 'Space Between Photos?', 'simple-elegant' ),
        'std' => '10',
        'placeholder' => esc_html__( 'Eg. 10px', 'simple-elegant' ),
    ),
    
    array(
        'id' => 'cache_time',
        'type' => 'select',
        'options' => array(
            (string) ( HOUR_IN_SECONDS/ 2 ) => esc_html__( 'Half Hours', 'simple-elegant' ),
            (string) ( HOUR_IN_SECONDS ) => esc_html__( 'An Hour', 'simple-elegant' ),
            (string) ( HOUR_IN_SECONDS * 2 ) => esc_html__( 'Two Hours', 'simple-elegant' ),
            (string) ( HOUR_IN_SECONDS * 4 ) => esc_html__( 'Four Hours', 'simple-elegant' ),
            (string) ( DAY_IN_SECONDS ) => esc_html__( 'A Day', 'simple-elegant' ),
            (string) ( WEEK_IN_SECONDS ) => esc_html__( 'A Week', 'simple-elegant' ),
        ),
        'std'   => (string) ( HOUR_IN_SECONDS * 2 ),
        'name'  => esc_html__( 'Cache Time', 'simple-elegant' ),
        'desc'  => esc_html__( 'If you do not often upload new photos, you can set longer caching time to speed up loading time.', 'simple-elegant' ),
    ),
    
    array(
        'id' => 'follow_text',
        'type' => 'text',
        'std'   => esc_html__( 'Follow Me!', 'simple-elegant' ),
        'name'  => esc_html__( 'Follow Text', 'simple-elegant' ),
    ),
    
);