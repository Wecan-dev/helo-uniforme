<?php
vc_map( array(
    'name' => __('Testimonial Slider', 'simple-elegant'),
    'base' => 'testimonial_slider',
    'weight'	=>	190,
    'icon' => plugins_url('../assets/icons/testimonial-slider.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
	'category' => array(
		esc_html__( 'Content', 'js_composer' ),
	),
    'params' => array(
        
        array(
            'type' => 'checkbox',
            'param_name' => 'auto',
            'heading' => __('Autoplay?','simple-elegant'),
            'value' => array( 'Enable' => 'true' ),
            'std' => 'true',
        ),

        array(
            'type' => 'checkbox',
            'param_name' => 'pager',
            'heading' => __('Pager?','simple-elegant'),
            'value' => array( 'Enable' => 'true' ),
            'std' => 'true',
        ),
        
        array(
            'type' => 'checkbox',
            'param_name' => 'navi',
            'heading' => __('Arrows?','simple-elegant'),
            'value' => array( 'Enable' => 'true' ),
            'std' => '',
        ),
        
        array(
            'type' => 'dropdown',
            'param_name' => 'align',
            'heading' => __( 'Align','simple-elegant'),
            'value' => array(
                'Left' => 'left',
                'Center' => 'center',
            ),
            'std' => 'left',
        ),
        
        array(
            'type' => 'param_group',
            'heading' => __( 'Testimonials', 'simple-elegant' ),
            'param_name' => 'testimonials',
            'description' => __( 'Enter value for each single testimonial', 'js_composer' ),
            'value' => urlencode( json_encode( array(
				array(
					'rating' => '4.8',
					'name' => 'John Doe',
                    'from' => 'USA',
                    // 'content' => 'Love this theme...it works the best for the application to which I implemented it. Thank you for your help and expedient support when need. Nice work...Just Awesome!',
				),
				array(
					'rating' => '4.2',
					'name' => 'Jane Doe',
                    'from' => 'Paris',
                    // 'content' => 'This is a beautiful theme - very distinctive and sophisticated. And the responsiveness to any questions I\'ve had has been excellent.',
				),
                array(
					'rating' => '5.0',
					'name' => 'Christina',
                    'from' => 'Germany',
                    // 'content' => 'Probably one of the most amazing wordpress themes ever. Clean, strong, great functionality, awesome care with the details and really ease to work in order to achieve extra personality. The support in a must, friendly and available to help the users',
				),
			) ) ),
            'params' => array(
                
                array(
                    'type' => 'attach_image',
                    'heading' => __('Avatar','simple-elegant'),
                    'param_name' => 'image',
                    'holder' => 'img',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Rating','simple-elegant'),
                    'param_name' => 'rating',
                    'description' => __('Should be a number between 0 and 5. Eg. 4.8','simple-elegant'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Name','simple-elegant'),
                    'param_name' => 'name',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('From','simple-elegant'),
                    'param_name' => 'from',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea',
                    'heading' => __('Content','simple-elegant'),
                    'param_name' => 'content',
                ),
                
            ),
        ),
        
    ),
) );
?>