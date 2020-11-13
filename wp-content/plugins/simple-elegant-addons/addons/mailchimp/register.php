<?php
/**
 * Mailchimp Form Addon for Visual Composer
 *
 * @since 2.3
 */
if ( ! class_exists( 'Withemes_Mailchimp_Form' ) ) :

class Withemes_Mailchimp_Form extends Withemes_Shortcode
{
    
    public function __construct() {
        
        $this->path = SIMPLE_ELEGANT_ADDONS_PATH . 'addons/mailchimp/';
        $this->args = array(
            'base'      => 'mailchimp_form',
            'name'      => esc_html__( 'Mailchimp', 'simple-elegant' ),
            'desc'      => esc_html__( 'Displays Mailchimp Subscribe/Newsletter Form', 'simple-elegant' ),
            'weight'    => 190,
        );
        
    }
    
    function param_list() {
        
        return 'title, description, form, align, layout, input_size, color, inner_css';

    }
    
}



function withemes_mailchimp_form_class_init() {
    $instance = new Withemes_Mailchimp_Form();
    $instance->init();
}

// we use this way to so that post type registered first
add_action( 'init', 'withemes_mailchimp_form_class_init', 8 );

endif;