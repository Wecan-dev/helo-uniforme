<?php
$params = array();
    
/* Number of posts
------------------------ */
$params[] = array(
    'type' => 'textfield',
    'heading' => 'Number of posts',
    'param_name' => 'number',
    'value' => '3',
);
    
$params[] = array (
    'type' => 'dropdown',
    'heading' => 'Column',
    'param_name' => 'column',
    'value' => array( 
        '2 Columns' => '2',
        '3 Columns' => '3',
        '4 Columns' => '4',
    ),
    'std' => '3',
    'admin_label' => true,
);

$params[] = array (
    'type' => 'dropdown',
    'heading' => 'Item Spacing',
    'param_name' => 'item_spacing',
    'value' => array(
        'Narrow' => 'narrow',
        'Wide' => 'wide',
    ),
    'std' => 'narrow',
);

// DESIGN OPTIONS
//
$params[] = array(
    'type' => 'css_editor',
    'heading' => esc_html__( 'Css', 'simple-elegant' ),
    'param_name' => 'css',
    'group' => esc_html__( 'Design Options', 'simple-elegant' ),
);