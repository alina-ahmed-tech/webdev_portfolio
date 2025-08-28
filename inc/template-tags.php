<?php
/**
 * Template helpers
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Output pagination with Bootstrap markup.
 */
function devfolio_pagination( $query = null ) {
	if ( ! $query ) { global $wp_query; $query = $wp_query; }

	$big = 999999999;
	$links = paginate_links( [
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $query->max_num_pages,
		'prev_text' => __('« Prev','devfolio'),
		'next_text' => __('Next »','devfolio'),
		'type'      => 'array',
	] );

	if ( is_array( $links ) ) {
		echo '<nav class="mt-4" aria-label="Pagination"><ul class="pagination justify-content-center">';
		foreach ( $links as $link ) {
			$active = strpos( $link, 'current' ) !== false ? ' active' : '';
			echo '<li class="page-item' . $active . '">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
		}
		echo '</ul></nav>';
	}
}
