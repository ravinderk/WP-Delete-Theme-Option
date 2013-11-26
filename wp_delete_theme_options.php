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
	if( ( isset( $_GET['action'] ) && $_GET['action'] ==='delete' ) && ( isset( $_GET['stylesheet'] ) && $_GET['stylesheet'] !='' ) ){
	
		global $wpdb;
		$theme_name = esc_attr( $_GET['stylesheet'] ); // theme directory name base for all option names
		
		$all_options_of_theme = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT option_name FROM $wpdb->options WHERE option_name LIKE  '%%%s%%'",
					$theme_name
				)
		); // get all option
	
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
