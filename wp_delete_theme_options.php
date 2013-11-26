<?php
/*
Plugin Name: Delete Theme Options
Plugin URI: http://blogdesignstudio
Description: delete all theme specific options
Author: Mayank Gupta / Ravinder Kumar
Version: 0.1
Author URI: http://blogdesignstudio
*/

function ravs_themeDeactivationFx( $oldname, $oldtheme=false ) {
	// update_option( 'ravs_theme', str_replace( ' ', '_', strtolower( $oldname ) ) );
	
	global $wpdb;
	$theme_name = str_replace( ' ', '_', strtolower( $oldname ) ); // theme name
	
	$all_options_of_theme = $wpdb->get_results("SELECT option_name FROM $wpdb->options WHERE option_name LIKE  '%{$theme_name}%'"); // get all option

	if( ! empty( $all_options_of_theme ) ){
		foreach ($all_options_of_theme as $option) {
			delete_option( $option->option_name );
		}
	}
}
add_action( "after_switch_theme", "ravs_themeDeactivationFx", 10 , 2 );

?>
