<?php
/**
 * Index fallback
 *
 * @package devfolio
 */
get_header();
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', get_post_type() );
	endwhile;
	devfolio_pagination();
else :
	echo '<p>' . esc_html__( 'No content found.', 'devfolio' ) . '</p>';
endif;
get_footer();
