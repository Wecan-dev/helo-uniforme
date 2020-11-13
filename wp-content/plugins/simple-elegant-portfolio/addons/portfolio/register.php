<?php
/**
 * Portfolio Addon for Visual Composer
 *
 * @since 1.0
 * @rewritten in 2.0 & 2.3
 */
if ( ! class_exists( 'Withemes_Portfolio_Shortcode' ) && class_exists( 'Withemes_Shortcode' ) ) :

class Withemes_Portfolio_Shortcode extends Withemes_Shortcode
{
    
    public function __construct() {
        
        $this->path = SIMPLE_ELEGANT_PORTFOLIO_PATH . 'addons/portfolio/';
        $this->args = array(
            'base'      => 'portfolio',
            'name'      => esc_html__( 'Portfolio', 'simple-elegant' ),
            'desc'      => esc_html__( 'Displays Recent Projects', 'simple-elegant' ),
            'weight'    => 190,
        );
        
        // Narrow data taxonomies
        add_filter( 'vc_autocomplete_portfolio_cats_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
        add_filter( 'vc_autocomplete_portfolio_cats_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );
        
    }
    
    function param_list() {
    
        return 'number, cats, style, rollover_background, rollover_color, ratio, pagination, catlist, column, item_spacing, css';
        
    }
    
}

$instance = new Withemes_Portfolio_Shortcode();
$instance->init();

endif;