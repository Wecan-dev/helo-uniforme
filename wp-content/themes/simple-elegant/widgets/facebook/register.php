<?php
/**
 * Facebook Like Box
 *
 * @package Rachel
 * @since 1.0
 */

if ( !class_exists( 'Withemes_Widget_Facebook_Likebox' ) ) :

add_action( 'widgets_init', 'withemes_register_widget_facebook_likebox' );

function withemes_register_widget_facebook_likebox() {

    register_widget( 'Withemes_Widget_Facebook_Likebox' );

}

add_action( 'wp_enqueue_scripts', 'withemes_register_facebook_scripts' );
    
function withemes_register_facebook_scripts() {
    
    // facebook
    wp_register_script( 'wi-facebook', 'https://connect.facebook.net/en_US/all.js#xfbml=1', false, '1.0', true );
    
}

class Withemes_Widget_Facebook_Likebox extends Withemes_Widget {
	
    // initialize the widget
	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_facebook_likebox', 
            'description' => esc_html__( 'Displays Facebook like box','simple-elegant' )
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'wi-facebook', esc_html__( '(S&E) Facebook Likebox' , 'simple-elegant' ), $widget_ops, $control_ops );
	}
    
    // register fields
    // Withemes_Widget class does the rest
    function fields() {
        include get_template_directory() . '/widgets/facebook/fields.php';
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include get_template_directory() . '/widgets/facebook/widget.php';
        
	}
	
}

endif;