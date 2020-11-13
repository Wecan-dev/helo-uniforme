<?php
/**
 * Instagram
 *
 * @package Rachel
 * @since 1.0
 */

if ( !class_exists( 'Withemes_Widget_Instagram' ) ) :

add_action( 'widgets_init', function() {

    register_widget( 'Withemes_Widget_Instagram' );

} );

class Withemes_Widget_Instagram extends Withemes_Widget {
	
    // initialize the widget
	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_instagram', 
            'description' => esc_html__( 'Displays Instagram Grid','simple-elegant' )
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'wi-instagram', esc_html__( '(S&E) Instagram' , 'simple-elegant' ), $widget_ops, $control_ops );
	}
    
    // register fields
    // Withemes_Widget class does the rest
    function fields() {
        include get_template_directory() . '/widgets/instagram/fields.php';
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include get_template_directory() . '/widgets/instagram/widget.php';
        
	}
	
}

endif;