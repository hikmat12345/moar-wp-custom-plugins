<?php
/**
 * Plugin Name:       Moar 	Featurd Artist
 * Plugin URI:        https://no-yet
 * Description:       Artist Competetion
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hikmat Ullah Khan CACF
 * Author URI:        https://live_moar
 * License:           GPL v1 or later
 * License URI:       https://no
 * Text Domain:       CACF_Moar_Artist_Competetion
 * Domain Path:       /languages
 */

// register_activation_hook( __FILE__, 'wpq_list_terms_exclusions' );
// register_deactivation_hook( __FILE__, 'wpq_list_terms_exclusions' );
// register_activation_hook( __FILE__, 'wpq_created_term' );
// register_deactivation_hook( __FILE__, 'wpq_created_term' );


/*
	==========================================
	 Custom Recomendation Type
	==========================================
*/
define('Plugin_path_url_list', plugin_dir_path( __FILE__ ));


function featurd_artist_menu_page() {
	add_menu_page( 'Featured Artist ', 'Featurd Artist' , 'manage_options', 'featured_artist', 'featurd_artist_func', 'dashicons-admin-users',8 );
}
add_action('admin_menu', 'featurd_artist_menu_page');
	
function featurd_artist_func(){ 
	include(Plugin_path_url_list.'list-pages/artist-list.php');

}
	?>