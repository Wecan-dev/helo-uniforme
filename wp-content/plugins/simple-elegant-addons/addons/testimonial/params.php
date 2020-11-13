<?php
$params = array(
    
    array(
        'type' => 'attach_image',
        'heading' => esc_html__('Avatar','simple-elegant'),
        'param_name' => 'image',
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Rating','simple-elegant'),
        'param_name' => 'rating',
        'description' => esc_html__('Should be a number between 0 and 5. Eg. 4.8','simple-elegant'),
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Name','simple-elegant'),
        'param_name' => 'name',
        'admin_label' => true,
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('From','simple-elegant'),
        'param_name' => 'from',
        'admin_label' => true,
    ),
    
    array(
        'type' => 'dropdown',
        'heading' => esc_html__('Align','simple-elegant'),
        'param_name' => 'align',
        'value' => array(
            'Left' => 'left',
            'Center' => 'center',
        ),
        'std' => 'left',
    ),
    
    array(
        'type' => 'textarea_html',
        'heading' => esc_html__('Content','simple-elegant'),
        'param_name' => 'content',
    ),
    
    // DESIGN OPTIONS
    array(
        'type' => 'css_editor',
        'heading' => esc_html__( 'Css', 'simple-elegant' ),
        'param_name' => 'css',
        'group' => esc_html__( 'Design Options', 'simple-elegant' ),
    )
    
);