<?php
/**
 * Plugin Name:       Moar 	Endpoints
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
define('Plugin_path_url_endpoint_list', plugin_dir_path( __FILE__ ));


add_action('rest_api_init', 'moar_apis');
	
function moar_apis(){
	include(Plugin_path_url_endpoint_list.'Endpoints/home-page-api.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/latest_comp.php');
    include(Plugin_path_url_endpoint_list.'Endpoints/publics/previus_comp.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/current_comps.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/closed-comp-list.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/competition-result.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/no_use_entries.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/user-voting.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/add-entery.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/read-files.php');
    include(Plugin_path_url_endpoint_list.'Endpoints/publics/test_add_file.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/upload_file.php');
	include(Plugin_path_url_endpoint_list.'Endpoints/publics/list_of_entries.php');
}
	?>