<?php
/**
 * Testimonial Addon for Visual Composer
 *
 * @since 2.3
 */
if ( ! class_exists( 'Withemes_Testimonial' ) ) :

class Withemes_Testimonial extends Withemes_Shortcode
{
    
    public function __construct() {
        
        $this->path = SIMPLE_ELEGANT_ADDONS_PATH . 'addons/testimonial/';
        $this->args = array(
            'base'      => 'testimonial',
            'name'      => esc_html__( 'Testimonial', 'simple-elegant' ),
            'desc'      => esc_html__( 'Displays a single testimonial', 'simple-elegant' ),
            'weight'    => 190,
            'icon'      => 'withemes-vc-icon',
        );
        
    }
    
    function param_list() {
        
        return 'image, rating, name, from, align, css';
        
    }
    
}

$instance = new Withemes_Testimonial();
$instance->init();

endif;