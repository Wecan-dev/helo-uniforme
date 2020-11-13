<?php
/**
 * Helper functions
 * @since 2.4
 */

if ( ! function_exists( 'withemes_get_instagram_photos' ) ) :
/**
 * retrieve instagram photos
 *
 * @since 2.0
 * fixed in 2.3
 */
function withemes_get_instagram_photos( $access_token, $number, $cache_time ) {

    /**
     * Get Instagram Photos
     */
    $access_token = trim( $access_token );
    $number = absint( $number );
    $cache_time = absint( $cache_time );

    if ( ! $access_token ) return;

    if ( $number < 1 || $number > 100 ) $number = 9;

    if ( false === ( $instagram = get_transient( 'withemes-instagram-' . sanitize_title_with_dashes( $access_token . '-' . $number ) ) ) ) {

        $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$access_token}&count={$number}";

        $remote = wp_remote_get( $url, array(
            'decompress' => false,
        ) );

        if ( is_wp_error( $remote ) )
            return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'simple-elegant' ) );

        if ( 200 != wp_remote_retrieve_response_code( $remote ) )
            return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'simple-elegant' ) );

        $insta_array = json_decode( $remote['body'], true );

        if ( ! $insta_array )
            return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'simple-elegant' ) );

        if ( isset( $insta_array['data'] ) ) {
            $images = $insta_array['data'];
        } else {
            return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'simple-elegant' ) );
        }

        $instagram = array();

        foreach ( $images as $image ) {

            $return = array(
                'description'   => isset( $image[ 'caption'][ 'text' ] ) ? $image[ 'caption'][ 'text' ] : esc_html__( 'Instagram Photo', 'simple-elegant' ),
                'link'		  	=> isset( $image[ 'link' ] ) ? $image[ 'link' ] : '',
                'time'		  	=> isset( $image[ 'created_time' ] ) ? $image[ 'created_time' ] : '',
                'comments'	  	=> isset( $image[ 'comments' ]['count'] ) ? $image[ 'comments' ]['count'] : '',
                'likes'		 	=> isset( $image[ 'likes' ]['count'] ) ? $image[ 'likes' ]['count'] : '',
                'thumbnail'	 	=> isset( $image[ 'images' ]['thumbnail']['url'] ) ? $image[ 'images' ]['thumbnail']['url'] : '',
                'type'		  	=> isset( $image[ 'type' ] ) ? $image[ 'type' ] : 'image',
            );
            
            if ( isset( $image[ 'images' ][ 'low_resolution' ][ 'url' ] ) ) {
                
                $return[ 'medium' ] = $image[ 'images' ][ 'low_resolution' ][ 'url' ];
            
            } else {
                $return[ 'medium' ] = $return[ 'thumbnail' ];
            }
            
            if ( isset( $image[ 'images' ][ 'standard_resolution' ][ 'url' ] ) )
                $return[ 'large' ] = $image[ 'images' ][ 'standard_resolution' ][ 'url' ];
            else $return[ 'large' ] = $return[ 'thumbnail' ];
            
            $instagram[] = $return;

        }

        // do not set an empty transient - should help catch private or empty accounts
        if ( ! empty( $instagram ) ) {
            set_transient( 'withemes-instagram-'.sanitize_title_with_dashes( $access_token . '-' . $number ), $instagram, $cache_time );
        }
    }

    if ( ! empty( $instagram ) ) {

        return array_slice( $instagram, 0, $number );

    } else {

        return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'simple-elegant' ) );

    }

}
endif;

if ( ! function_exists( 'withemes_get_instagram_photos_from_username' ) ) :
/**
 * retrieve instagram photos
 *
 * @since 2.4
 */
function withemes_get_instagram_photos_from_username( $username, $number, $cache_time ) {

    /**
     * Get Instagram Photos
     */
    $username = trim( $username );
    $number = absint( $number );
    $cache_time = absint( $cache_time );

    if ( ! $username ) return;

    if ( $number < 1 || $number > 12 ) $number = 6;

    switch ( substr( $username, 0, 1 ) ) {
        case '#':
            $url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
            $transient_prefix = 'h';
            break;

        default:
            $url              = 'https://instagram.com/' . str_replace( '@', '', $username );
            $transient_prefix = 'u';
            break;
    }

    if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

        $remote = wp_remote_get( $url );

        if ( is_wp_error( $remote ) ) {
            return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'simple-elegant' ) );
        }

        if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
            return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'simple-elegant' ) );
        }

        $shards      = explode( 'window._sharedData = ', $remote['body'] );
        $insta_json  = explode( ';</script>', $shards[1] );
        $insta_array = json_decode( $insta_json[0], true );

        if ( ! $insta_array ) {
            return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'simple-elegant' ) );
        }

        if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
            $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
        } elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
            $images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
        } else {
            return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'simple-elegant' ) );
        }

        if ( ! is_array( $images ) ) {
            return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'simple-elegant' ) );
        }

        $instagram = array();

        foreach ( $images as $image ) {
            if ( true === $image['node']['is_video'] ) {
                $type = 'video';
            } else {
                $type = 'image';
            }

            $caption = __( 'Instagram Image', 'simple-elegant' );
            if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
                $caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
            }

            $instagram[] = array(
                'description' => $caption,
                'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
                'time'        => $image['node']['taken_at_timestamp'],
                'comments'    => $image['node']['edge_media_to_comment']['count'],
                'likes'       => $image['node']['edge_liked_by']['count'],
                'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
                'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
                'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
                'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
                'type'        => $type,
            );
        } // End foreach().

        // do not set an empty transient - should help catch private or empty accounts.
        if ( ! empty( $instagram ) ) {
            $instagram = base64_encode( serialize( $instagram ) );
            set_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', $cache_time ) );
        }
    }

    if ( ! empty( $instagram ) ) {

        $instagram = unserialize( base64_decode( $instagram ) );

    } else {

        return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'simple-elegant' ) );

    }
    
    if ( ! empty( $instagram ) ) {

        return array_slice( $instagram, 0, $number );

    } else {

        return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'simple-elegant' ) );

    }

}
endif;