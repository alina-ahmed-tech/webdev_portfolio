<?php
/**
 * Custom Post Types
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function() {
	$labels = [
		'name'               => __( 'Projects', 'devfolio' ),
		'singular_name'      => __( 'Project', 'devfolio' ),
		'add_new_item'       => __( 'Add New Project', 'devfolio' ),
		'edit_item'          => __( 'Edit Project', 'devfolio' ),
		'new_item'           => __( 'New Project', 'devfolio' ),
		'view_item'          => __( 'View Project', 'devfolio' ),
		'search_items'       => __( 'Search Projects', 'devfolio' ),
		'not_found'          => __( 'No projects found', 'devfolio' ),
		'not_found_in_trash' => __( 'No projects found in Trash', 'devfolio' ),
		'all_items'          => __( 'All Projects', 'devfolio' ),
		'menu_name'          => __( 'Projects', 'devfolio' ),
	];

	register_post_type( 'projects', [
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'has_archive'        => true,
		'rewrite'            => [ 'slug' => 'projects' ],
		'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ],
		'menu_icon'          => 'dashicons-portfolio',
	] );
});
