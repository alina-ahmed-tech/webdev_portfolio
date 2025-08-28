<?php
/**
 * Template Name: WordPress Portfolio
 * Description: Shows only Projects with (ACF field) projectType 'WordPress'.
 *
 * @package devfolio
 */

get_header();

$paged = max( 1, get_query_var( 'paged' ) );
$meta_key = 'projectType'; // ACF field name
$meta_val = 'WordPress';

$q = new WP_Query([
	'post_type'      => 'projects',
	'posts_per_page' => 9,
	'paged'          => $paged,
	'meta_query'     => [
		[
			'key'     => $meta_key,
			'value'   => $meta_val,
			'compare' => '=',
		]
	],
]);

echo '<header class="mb-4"><h1 class="h3">' . esc_html__( 'WordPress Projects', 'devfolio' ) . '</h1></header>';

echo '<div class="row g-4">';
if ( $q->have_posts() ) :
	while ( $q->have_posts() ) : $q->the_post(); ?>
		<div class="col-md-6 col-lg-4">
			<article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 shadow-sm'); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'project-thumb', [ 'class' => 'card-img-top' ] ); ?>
				<?php endif; ?>
				<div class="card-body d-flex flex-column">
					<h2 class="h5 card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="badge bg-primary mb-3">WordPress</p>
					<p class="card-text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt(), true ) ); ?></p>
					<div class="mt-auto">
						<a class="btn btn-outline-primary btn-sm" href="<?php the_permalink(); ?>"><?php esc_html_e('View project', 'devfolio'); ?></a>
					</div>
				</div>
			</article>
		</div>
	<?php endwhile;
else :
	echo '<p>' . esc_html__( 'No WordPress projects found yet.', 'devfolio' ) . '</p>';
endif;
echo '</div>';

devfolio_pagination( $q );
wp_reset_postdata();

get_footer();
