<?php
$params[] = array(
    'type' => 'attach_images',
    'heading' => 'Upload images',
    'param_name' => 'images',
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Layout',
    'param_name' => 'layout',
    'value' => array(
        'Normal Grid' => 'grid',
        'Metro' => 'metro',
    ),
);

$params[] = array(
    'type' => 'checkbox',
    'heading' => 'Show caption?',
    'param_name' => 'caption',
    'value' => array(
        'Enable' => 'true',
    ),
);

$params[] = array(
    'type' => 'textfield',
    'heading' => 'Image Size',
    'param_name' => 'thumb',
    'value' => 'wi-square',
    'description' => 'Enter image size. Example: "wi-square" (400x400), "wi-medium" (400x300), "wi-portrait" (400x500), "full" (original size). Alternatively enter size in pixels (Example: 1000x400 (Width x Height)).',
    
    'dependency' => array(
        'element' => 'layout',
        'value' => 'grid',
    ),
);

$params[] = array(
    'type' => 'textfield',
    'heading' => 'Image Ratio',
    'param_name' => 'thumb_ratio',
    'value' => '1:1',
    'description' => 'Enter syntax: "WIDTH:HEIGHT"',
    
    'dependency' => array(
        'element' => 'layout',
        'value' => 'metro',
    ),
);

$params[] = array (
    'type' => 'checkbox',
    'heading' => 'Open Lightbox?',
    'param_name' => 'lightbox',
    'value' => array( 'Yes Please' => 'true' ),
    'std' => '',
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Column?',
    'description' => 'This option only applies for "Grid Layout".',
    'param_name' => 'column',
    'value' => array(
        '1-Column' => '1',
        '2-Column' => '2',
        '3-Column' => '3',
        '4-Column' => '4',
        '5-Column' => '5',
        '6-Column' => '6',
        '7-Column' => '7',
        '8-Column' => '8',
        '9-Column' => '9',
        '10-Column' => '10',
    ),
    'std' => '3',
    
    'group' => 'Design',
);

$params[] = array(
    'type' => 'textfield',
    'heading' => 'Space between Items',
    'description' => 'Default is 24px. You can enter other number, eg 50, 20 or 1...',
    'param_name' => 'item_spacing',
    'group' => 'Design',
);