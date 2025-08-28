<?php
/**
 * Theme setup & assets
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Theme supports & menus.
 */
add_action( 'after_setup_theme', function() {
	// Core supports.
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/main.css' );

	// Image sizes.
	add_image_size( 'project-thumb', 800, 600, true );

	// Menus.
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'devfolio' ),
		'footer'  => __( 'Footer Menu', 'devfolio' ),
	] );
});

/**
 * Enqueue styles & scripts.
 * Mobile-first: minimal CSS + defer scripts for speed.
 */
add_action( 'wp_enqueue_scripts', function() {
	// Bootstrap 5 (CSS)
	wp_enqueue_style(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
		[],
		'5.3.3'
	);

	// Theme CSS (compiled from SCSS).
	wp_enqueue_style(
		'devfolio-main',
		DEVFOLIO_URI . 'assets/css/main.css',
		[ 'bootstrap' ],
		filemtime( DEVFOLIO_DIR . 'assets/css/main.css' )
	);

	// Bootstrap JS (Bundle includes Popper).
	wp_enqueue_script(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
		[],
		'5.3.3',
		true
	);
	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_script_add_data( 'bootstrap', 'strategy', 'defer' );
	}

	// Theme JS
	wp_enqueue_script(
		'devfolio-main',
		DEVFOLIO_URI . 'assets/js/main.js',
		[],
		filemtime( DEVFOLIO_DIR . 'assets/js/main.js' ),
		true
	);
	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_script_add_data( 'devfolio-main', 'strategy', 'defer' );
	}

	// Preload fonts example (if add any self-hosted fonts).
	// wp_enqueue_style( 'devfolio-fonts', DEVFOLIO_URI . 'assets/fonts/fonts.css', [], DEVFOLIO_VERSION );
});

/**
 * Clean up defaults for performance.
 */
add_action( 'init', function() {
	// Disable emojis.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
});

/**
 * Resource hints (performance).
 */
add_filter( 'wp_resource_hints', function( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://cdn.jsdelivr.net';
	}
	return $urls;
}, 10, 2 );

/**
 * Basic SEO meta description fallback if no SEO plugin.
 */
add_action( 'wp_head', function() {
	if ( function_exists( 'rank_math' ) || class_exists( 'WPSEO_Frontend' ) ) {
		return; // Let SEO plugin handle.
	}
	if ( is_singular() ) {
		global $post;
		$desc = get_the_excerpt( $post );
	} else {
		$desc = get_bloginfo( 'description', 'display' );
	}
	$desc = wp_strip_all_tags( $desc );
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . PHP_EOL;
	}
}, 1 );

/**
 * Schema.org JSON-LD (Person + WebSite minimal)
 */
add_action( 'wp_head', function() {
	$schema = [
		'@context' => 'https://schema.org',
		'@graph'   => [
			[
				'@type' => 'WebSite',
				'url'   => home_url( '/' ),
				'name'  => get_bloginfo( 'name' ),
				'description' => get_bloginfo( 'description', 'display' ),
				'potentialAction' => [
					'@type' => 'SearchAction',
					'target' => home_url( '?s={search_term_string}' ),
					'query-input' => 'required name=search_term_string',
				]
			],
			[
				'@type' => 'Person',
				'name'  => get_bloginfo( 'name' ),
				'url'   => home_url( '/' ),
			],
		],
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . PHP_EOL;
}, 20 );
