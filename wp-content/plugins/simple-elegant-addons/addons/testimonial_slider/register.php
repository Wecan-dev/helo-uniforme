<?php
/**
 * Testimonial Slider Addon for Visual Composer
 *
 * @since 1.0
 * @modified 2.0
 */
if ( ! class_exists( 'Withemes_Testimonial_Slider' ) ) :

class Withemes_Testimonial_Slider extends Withemes_Shortcode
{
    
    public function __construct() {
        
        $this->path = SIMPLE_ELEGANT_ADDONS_PATH . 'addons/testimonial_slider/';
        $this->args = array(
            'base'      => 'testimonial_slider',
            'name'      => esc_html__( 'Testimonial Slider', 'simple-elegant' ),
            'desc'      => esc_html__( 'Displays testimonial slider', 'simple-elegant' ),
            'weight'    => 190,
        );
        
    }
    
    function param_list() {
        
        return 'auto, pager, align, testimonials';
        
    }
    
}

$instance = new Withemes_Testimonial_Slider();
$instance->init();

endif;