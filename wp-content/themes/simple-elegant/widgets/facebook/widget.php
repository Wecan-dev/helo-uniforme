<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '6',
    'url' => 'https://www.facebook.com/withemes',
    'showfaces' => '',
    'stream' => '',
    'header' => '',
) ) );
echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

if ( ! $url ) return;

$stream = $stream ? 'true' : 'false';
$showfaces = $showfaces ? 'true' : 'false';
$header = $header ? 'true' : 'false';
		
wp_enqueue_script( 'wi-facebook' );

$like_box_xfbml = "<fb:like-box href=\"$url\" width=\"290\" show_faces=\"$showfaces\" colorscheme=\"light\" border_color=\"#e9e9e9\" stream=\"$stream\" header=\"$header\"></fb:like-box>";
echo '<div class="fb-container">' . $like_box_xfbml . '</div>';

echo $after_widget;