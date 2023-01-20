<?php
/**
 * Plugin Name:       Moar recomendation
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
function moar_custom_post_type_recomdation (){
	
	$labels = array(
		'name' => 'Add',
		'singular_name' => 'Recomendation',
		'add_new' => 'Add ',
		'all_items' => 'All',
		'add_new_item' => 'Add ',
		'edit_item' => 'Edit ',
		'new_item' => 'New ',
		'view_item' => 'View ',
		'search_item' => 'Search ',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		//'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
// 			'editor',
// 			'excerpt',
// 			'thumbnail',
// 			'revisions',
		),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('Recomendation',$args);
}
add_action('init','moar_custom_post_type_recomdation');
