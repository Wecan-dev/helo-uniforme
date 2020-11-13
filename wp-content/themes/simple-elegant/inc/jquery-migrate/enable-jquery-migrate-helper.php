<?php
if ( version_compare( $GLOBALS['wp_version'], '5.6-alpha', '<' ) && ! class_exists( 'jQuery_Migrate_Helper' ) ) {
	include_once __DIR__ . '/class-jquery-migrate-helper.php';
    add_action( 'after_setup_theme', array( 'jQuery_Migrate_Helper', 'init_actions' ) );
}
