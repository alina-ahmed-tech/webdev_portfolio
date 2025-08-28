<?php
/**
 * Demo content on theme activation
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'after_switch_theme', function() {
	// Create Pages
	$pages = [
		'About' => [
			'content' => "<p>This is where I need to place content about who I am, a short bio paragraph section.</p>
<p>Email: <a href='mailto:alina.144.132@gmail.com'>alina.144.132@gmail.com</a><br>LinkedIn: <a href='https://www.linkedin.com/in/alina-ahmed-tech/ target='_blank' rel='noopener'>https://www.linkedin.com/in/alina-ahmed-tech/</a><br>GitHub: <a href='https://github.com/alina-ahmed-tech' target='_blank' rel='noopener'>https://github.com/alina-ahmed-tech</a></p>",
			'template' => 'default',
		],
		'All Projects' => [
			'content'  => '',
			'template' => 'page-templates/template-all-projects.php',
		],
		'All Blogs' => [
			'content'  => '',
			'template' => 'page-templates/template-all-blogs.php',
		],
		'WordPress Portfolio' => [
			'content'  => '',
			'template' => 'page-templates/template-wordpress-portfolio.php',
		],
	];

	$page_ids = [];
	foreach ( $pages as $title => $data ) {
		$existing = get_page_by_title( $title );
		if ( $existing ) {
			$page_ids[ $title ] = $existing->ID;
			continue;
		}
		$id = wp_insert_post( [
			'post_title'   => $title,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => $data['content'],
		] );
		if ( $id && ! is_wp_error( $id ) ) {
			if ( 'default' !== $data['template'] ) {
				update_post_meta( $id, '_wp_page_template', $data['template'] );
			}
			$page_ids[ $title ] = $id;
		}
	}

	// Set static front page to About
	if ( ! empty( $page_ids['About'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_ids['About'] );
	}

	// Optionally set posts page to All Blogs (not required but handy)
	if ( ! empty( $page_ids['All Blogs'] ) ) {
		update_option( 'page_for_posts', $page_ids['All Blogs'] );
	}

	// Create demo blog posts
	$posts = [
		'Responsive Web Design Principles' => "
<p>Learn the core principles of responsive web design: fluid grids, flexible media, and media queries. Start mobile‑first, progressively enhance, and use CSS clamp() to create fluid typography. Test with real devices and throttled networks to ensure performance.</p>
<ul>
<li>Use semantic HTML and accessible patterns.</li>
<li>Design for touch first (hit areas ≥ 44px).</li>
<li>Prefer CSS layout (Flexbox/Grid) over JS.</li>
</ul>
",
		'Web Optimisation for Performance, Speed, SEO' => "
<p>Performance and SEO go hand‑in‑hand. Reduce JavaScript, compress images, lazy‑load below‑the‑fold media, and implement caching. Use Core Web Vitals as a north star.</p>
<ol>
<li>HTTP/2 + CDN, immutable asset hashing.</li>
<li>Image formats: AVIF/WEBP, responsive srcset sizes.</li>
<li>Ship critical CSS early; defer non‑critical JS.</li>
</ol>
",
		'How to Add AI to Websites' => "
<p>Bring AI into your site for search, recommendations, and content assistance. Start with a simple inference API and add privacy controls. Cache responses, stream results, and provide transparent UX.</p>
<p>Use background jobs for long‑running tasks and measure value with A/B tests before scaling.</p>
",
	];

	foreach ( $posts as $title => $content ) {
		if ( get_page_by_title( $title, OBJECT, 'post' ) ) { continue; }
		wp_insert_post( [
			'post_title'   => $title,
			'post_status'  => 'publish',
			'post_type'    => 'post',
			'post_content' => $content,
		] );
	}

	// Create 3 Project posts with ACF projectType
	$projects = [
		'WordPress Portfolio Site' => 'WordPress',
		'Internal Tools Dashboard' => 'Software',
		'AI Chat Assistant'        => 'AI',
	];
	foreach ( $projects as $title => $type ) {
		$exists = get_page_by_title( $title, OBJECT, 'projects' );
		if ( $exists ) { continue; }
		$pid = wp_insert_post( [
			'post_title'   => $title,
			'post_status'  => 'publish',
			'post_type'    => 'projects',
			'post_content' => '<p>Project summary goes here. Describe tech stack, challenges, outcomes, and links.</p>',
		] );
		if ( $pid && ! is_wp_error( $pid ) ) {
			if ( function_exists( 'update_field' ) ) {
				update_field( 'field_devfolio_project_type', $type, $pid );
			} else {
				update_post_meta( $pid, 'projectType', $type );
			}
		}
	}
});
