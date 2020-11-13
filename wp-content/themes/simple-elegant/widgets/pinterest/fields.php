<?php
$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'simple-elegant' ),
        'std' => 'Latest Pins',
    ),
    
    array(
        'id' => 'username',
        'type' => 'text',
        'name' => 'Username',
        'std' => 'pinterest',
    ),
    
    // Username Board: (Optional) 
    array(
        'id' => 'boardname',
        'type' => 'text',
        'name' => 'Username Board: (Optional) ',
    ),
    
    array(
        'id' => 'maxfeed',
        'type' => 'text',
        'name' => 'Max number of pins to display:',
        'std' => '6',
    ),
    
    array(
        'id' => 'follow',
        'type' => 'text',
        'name' => 'Follow Text',
        'std' => 'Follow Us',
    ),
    
);