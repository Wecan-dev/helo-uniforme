<?php
/**
 * Imagebox Addon for Visual Composer
 *
 * @since 1.0
 */
if ( ! class_exists( 'Withemes_Imagebox' ) ) :

class Withemes_Imagebox extends Withemes_Shortcode
{
    
    public function __construct() {
        
        $this->path = SIMPLE_ELEGANT_ADDONS_PATH . 'addons/imagebox/';
        $this->args = array(
            'base'      => 'imagebox',
            'name'      => esc_html__( 'Imagebox', 'simple-elegant' ),
            'desc'      => esc_html__( 'Displays Imagebox', 'simple-elegant' ),
            'weight'    => 190,
        );
        
        add_filter ( 'withemes_element_class', array( $this, 'imagebox_class' ), 10, 3 );
        
    }
    
    function param_list() {
        
        return 'grid_element, box_width, box_spacing, image, title, subtitle, link, ratio, text_position, overlay, text_color, text, icon_set, icon, icon_budicon, btn_link, style, size, align, width, shape, onclick, padding_left, padding_top, border_radius, font_size, font_weight, text_transform, letter_spacing, border_width, color, background, border_color, hover_color, hover_background, hover_border, css';
        
    }
    
    // since 2.3
    function imagebox_class( $element_class, $base, $atts ) {
        
        if ( 'imagebox' == $base ) {
            
            if ( isset( $atts[ 'grid_element' ] ) && 'true' === $atts[ 'grid_element' ] ) {
            
                $element_class[] = 'imagebox-grid-item';
                if ( isset( $atts[ 'box_width' ] ) ) {
                    $element_class[] = 'col-' . $atts[ 'box_width' ];
                }
                if ( isset( $atts[ 'box_spacing' ] ) ) {
                    $element_class[] = 'box-spacing-' . $atts[ 'box_spacing' ];
                }
                
            }
            
        }
        
        return $element_class;
        
    }
    
}

$instance = new Withemes_Imagebox();
$instance->init();

endif;