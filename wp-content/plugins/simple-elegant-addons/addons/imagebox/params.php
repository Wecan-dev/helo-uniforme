<?php
$params[] = array(
    'type' => 'checkbox',
    'heading' => 'Use this box as a block of imagebox grid?',
    'description' => 'Check this if you\'re building a grid of image boxes',
    'param_name' => 'grid_element',
    'value' => array(
        'Yes' => 'true',
    ),
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Width in grid?',
    'param_name' => 'box_width',
    'value' => array(
        '100%' => '1',
        '1/2' => '1-2',
        '1/3' => '1-3',
        '2/3' => '2-3',
        '1/4' => '1-4',
        '3/4' => '3-4',
        '1/5' => '1-5',
        '2/5' => '2-5',
        '3/5' => '3-5',
        '4/5' => '4-5',
        '1/6' => '1-6',
        '5/6' => '5-6',
    ),
    'std' => '1-2',
    
    'dependency' => array(
        'element' => 'grid_element',
        'value' => 'true',
    ),
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Box Padding',
    'param_name' => 'box_spacing',
    'value' => array(
        'No spacing'=> 'none',
        'Thin'      => 'thin',
        'Large'     => 'large',
    ),
    'std' => 'thin',
    
    'dependency' => array(
        'element' => 'grid_element',
        'value' => 'true',
    ),
);

$params[] = array(
    'type' => 'textfield',
    'heading' => 'Box Ratio',
    'param_name' => 'ratio',
    'value' => '4:3',
);

$params[] = array(
    'type' => 'attach_images',
    'heading' => 'Upload your images',
    'param_name' => 'image',
);

$params[] = array(
    'type' => 'textfield',
    'heading' => 'Title',
    'param_name' => 'title',
    'value' => 'Imagebox Title',
    'admin_label' => true,
);

$params[] = array(
    'type' => 'textfield',
    'heading' => 'Subtitle',
    'param_name' => 'subtitle',
    'value' => 'Imagebox Subtitle',
    'admin_label' => true,
);

$params[] = array(
    'type' => 'vc_link',
    'heading' => 'Link',
    'param_name' => 'link',
);

$params[] = array (
    'type' => 'dropdown',
    'heading' => 'Text Position',
    'param_name' => 'text_position',
    'value' => array(
        'Top Left' => 'top-left',
        'Top Center' => 'top-center',
        'Top Right' => 'top-right',
        'Middle Left' => 'middle-left',
        'Middle Center' => 'middle-center',
        'Middle Right' => 'middle-right',
        'Bottom Left' => 'bottom-left',
        'Bottom Center' => 'bottom-center',
        'Bottom Right' => 'bottom-right',
    ),
    'std'   => 'middle-center',
);

$params[] = array(
    'type' => 'colorpicker',
    'heading' => 'Overlay Color',
    'param_name' => 'overlay',
    'value' => 'rgba(0,0,0,.3)',
);

$params[] = array(
    'type' => 'colorpicker',
    'heading' => 'Text Color',
    'param_name' => 'text_color',
);

// BUTTON
//
$button_params = withemes_button_params( 'Button', array(
    'text' => array(
        'type' => 'textfield',
        'heading' => 'Button Text',
        'description' => 'If button text entered, imagebox will set link to button instead of a wrap link for whole box',
        'value' => '',
        'param_name' => 'text',
    ),
    'link' => false,
) );
$params = array_merge( $params, $button_params );

// DESIGN OPTIONS
//
$params[] = array(
    'type' => 'css_editor',
    'heading' => esc_html__( 'Css', 'simple-elegant' ),
    'param_name' => 'css',
    'group' => esc_html__( 'Design Options', 'simple-elegant' ),
);