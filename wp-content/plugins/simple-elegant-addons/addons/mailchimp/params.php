<?php
$forms = array( 'Select Form' => '' );
$std = '';
$args = array(
    'post_type' => 'mc4wp-form',
    'posts_per_page' => 100,
    'ignore_sticky_posts' => true,
);
$get_forms = get_posts( $args );
foreach ( $get_forms as $form ) {
    if ( ! $std ) $std = strval($form->ID);
    $forms[ $form->post_title ] = strval($form->ID);
}

if ( ! $forms ) $forms = array( 'Please go to Dashboard > MailChimp for WP > Forms to create at least a form.' => '', );

$params[] = array (
    'type' => 'textfield',
    'heading' => 'Form Title',
    'param_name' => 'title',
    'value' => 'Subscribe',
    'admin_label' => true,
);

$params[] = array (
    'type' => 'textarea',
    'heading' => 'Form Content',
    'param_name' => 'description',
    'description' => 'This text will appear <strong>before</strong> the form.',
    'value' => 'SignUp to get latest news from us.',
    'admin_label' => true,
);

$params[] = array (
    'type' => 'dropdown',
    'heading' => 'Select Mailchimp Form',
    'param_name' => 'form',
    'value' => $forms,
    'std' => $std,
    'admin_label' => true,
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Align',
    'param_name' => 'align',
    
    'value' => array(
        'Left' => 'left',
        'Center' => 'center',
        'Right' => 'right',
    ),
    'std' => 'center',
    'admin_label' => true,
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Layout',
    'param_name' => 'layout',
    'description' => 'Inline form means all input fields lie in the same row',
    
    'value' => array(
        'Stack' => 'stack',
        'Inline' => 'inline',
    ),
    'std' => 'stack',
    'admin_label' => true,
);

$params[] = array(
    'type' => 'dropdown',
    'heading' => 'Input Size',
    'param_name' => 'input_size',
    
    'value' => array(
        'Normal' => 'normal',
        'Big' => 'big',
    ),
    
    'std' => 'normal',
);

$params[] = array(
    'type' => 'colorpicker',
    'heading' => 'Text Color',
    'param_name' => 'color',
);

// DESIGN OPTIONS
//
$params[] = array(
    'type' => 'css_editor',
    'heading' => esc_html__( 'Css', 'simple-elegant' ),
    'param_name' => 'inner_css',
    'group' => esc_html__( 'Design Options', 'simple-elegant' ),
);