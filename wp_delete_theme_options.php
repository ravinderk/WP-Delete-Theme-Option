<?php
/*
Plugin Name: WP Delete Theme Options
Plugin URI: http://blogdesignstudio
Description: delete all theme specific options
Author: Mayank Gupta / Ravinder Kumar
Version: 0.1
Author URI: http://blogdesignstudio
*/

function ravs_themeDeactivationFx( ) {
	
	// check user deleting theme or not
	if( ( isset( $_POST['action'] ) && $_POST['action'] ==='delete' ) && ( isset( $_POST['stylesheet'] ) && $_POST['stylesheet'] !='' ) ){
	
		global $wpdb;
		$theme_name = str_replace( ' ', '_', trim( strtolower( $oldname ) ) ); // theme name
		
		$all_options_of_theme = $wpdb->get_results("SELECT option_name FROM $wpdb->options WHERE option_name LIKE  '%{$theme_name}%'"); // get all option
	
		if( ! empty( $all_options_of_theme ) ){
			foreach ($all_options_of_theme as $option) {
				delete_option( $option->option_name );
			}
		}
	}
}

if( is_admin() )
	add_action( "init", "ravs_themeDeactivationFx" );

?>
