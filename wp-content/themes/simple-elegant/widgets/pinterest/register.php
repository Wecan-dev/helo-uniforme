<?php
/**
 * Pinterest
 *
 * @package Rachel
 * @since 1.0
 */

if ( !class_exists( 'Withemes_Widget_Pinterest' ) ) :

add_action( 'widgets_init', 'withemes_register_widget_pinterest' );

function withemes_register_widget_pinterest() {

    register_widget( 'Withemes_Widget_Pinterest' );

}

class Withemes_Widget_Pinterest extends Withemes_Widget {
	
    // initialize the widget
	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_pinterest', 
            'description' => esc_html__( 'Recent Pins','simple-elegant' )
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'wi-pinterest', esc_html__( '(S&E) Pinterest' , 'simple-elegant' ), $widget_ops, $control_ops );
	}
    
    // register fields
    // Withemes_Widget class does the rest
    function fields() {
        include get_template_directory() . '/widgets/pinterest/fields.php';
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include get_template_directory() . '/widgets/pinterest/widget.php';
        
	}
    
    /**
     * Get Pins Feed
     *
     * @since 1.0
     */
    function get_pins_feed_list( $username, $boardname, $maxfeeds = 6 ) {
        
        // Get Pinterest Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
        
        if( empty($boardname) ){
            $pinsfeed = 'https://pinterest.com/'.$username.'/feed.rss';
        } else {
            $pinsfeed = 'https://pinterest.com/'.$username.'/'.$boardname.'.rss';
        }
        
        // Get a SimplePie feed object from the Pinterest feed source
        $rss = fetch_feed($pinsfeed);
        if( $rss instanceof WP_Error ) return '';
        $rss->set_timeout(60);

        // Figure out how many total items there are.               
        $maxitems = $rss->get_item_quantity((int)$maxfeeds);
        
        // Build an array of all the items, starting with element 0 (first element).
        $rss_items = $rss->get_items(0,$maxitems);

        foreach ( $rss_items as $item ) { ?>

<li class="pin-item">

    <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" title="<?php echo esc_attr( $item->get_title() ); ?>">

        <?php
            if ( $thumb = $item->get_item_tags( SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail' ) ) {
                $thumb = $thumb[0]['attribs']['']['url'];											
                echo '<img src="'. esc_url( $thumb ).'" alt="'.$item->get_title().'"/>'; 
            }  else {
                preg_match('/src="([^"]*)"/', $item->get_content(), $matches);
                $src = $matches[1];

                if ($matches) {
                  echo '<img src="'.$src.'" alt="'.$item->get_title().'"/>';
                } else {
                  echo "thumbnail not available";
                }
            }
        ?>

    </a>
                
</li>

<?php
          } // foreach
    
    }
	
}

endif;