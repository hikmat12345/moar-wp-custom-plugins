<?php
/*
* Plugin Name: Moar fan club
* Plugin URI: https://wordpress.org
* Author: Hikmat Ullah
* Author URI: https://wordpress.org
* Description: this plugin is as portal for artist to create, read, and update stuff of club...
* Version: 1.0.0
* License: GPL2
* License URI:  https://www.no
* Text Domain: moar admin
*/
 
?>
<?php
// !define('ABSPATH') || 's';
define('Plugin_path_url_of_fc', plugin_dir_path( __FILE__ ));
define('plugin_path_of_fc', plugin_dir_url( __FILE__ ));
// define('tables_name', 'onetable');
if (!function_exists('bms_scripts'))
{
   function bms_scripts(){
   	wp_enqueue_script( 'bms_scripts', plugin_path_of_fc. 'js/bms_structus_js.js', true );
   	wp_enqueue_script( 'bms_jqueryfile', plugin_path_of_fc. 'js/bms_jqueryfile.js', 'JQuery', '1.0.0', true );
   	wp_enqueue_style( 'bms_css', plugin_path_of_fc. 'css/bms_structure.css' );
   	wp_enqueue_style( 'FrontEndDashboardCSS', plugin_path_of_fc. 'css/UiDasboard.css' );
   }
   add_action( 'wp_enqueue_scripts','bms_scripts');

}
//Top Level Administration Menu
function wpac_register_fc() {
    add_menu_page( 'artist portal ', 'Artist Portal' , 'manage_options', 'fc-settings', 'fc_settings_page_html', 'dashicons-megaphone',30 );
    add_submenu_page( 'fc-settings', 'create club', 'create club ', 'manage_options', 'create-club', 'create_club' );
    add_submenu_page( 'fc-settings', 'create message', 'create message', 'manage_options', 'create_message', 'recoreded_msgs' );
	add_submenu_page( 'fc-settings', 'delete', 'delete club', 'manage_options', 'delete_club', 'delete_club_fun' );
    add_submenu_page( 'fc-settings', 'Upadte club', 'Update club', 'manage_options', 'club_updated', 'update_club' );

	add_submenu_page( 'fc-settings', 'chat-room', 'chat-room club', 'manage_options', 'chat-room_club', 'chat_room' );
    add_submenu_page( 'fc-settings', 'follower-list', 'follower list', 'manage_options', 'followers', 'followers' );
	}
add_action('admin_menu', 'wpac_register_fc');

function fc_settings_page_html(){
	include(Plugin_path_url_of_fc.'pages/club-list.php');
}
// sub page one function
function create_club(){
	include(Plugin_path_url_of_fc.'pages/create-club.php');
}

// sub page three function
function recoreded_msgs(){
	include(Plugin_path_url_of_fc.'pages/recorded-msg.php');
}
function delete_clubfun(){
	include(Plugin_path_url_of_fc.'pages/delete_club.php');
}

function update_club(){
	include(Plugin_path_url_of_fc.'pages/update-club.php');
}
function chat_room(){
	include(Plugin_path_url_of_fc.'pages/chat-room.php');
}
function followers(){
	include(Plugin_path_url_of_fc.'pages/follower-list.php');
}


// Creation database by activation hook 
 
require 
plugin_dir_path( __FILE__ ). 'Database_tbl/customer.php';
register_activation_hook( __FILE__, 'bms_customers_tbl_fun' );
register_activation_hook( __FILE__,  'bms_signup' );
register_activation_hook( __FILE__,  'user_voting' );
register_activation_hook( __FILE__,  'enable_content_artist');



