<?php
/**
 * Projects archive
 *
 * @package devfolio
 */
get_header();
?>
<header class="mb-4">
  <h1 class="h3"><?php esc_html_e( 'All Projects', 'devfolio' ); ?></h1>
</header>

<div class="row g-4">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="col-md-6 col-lg-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 shadow-sm'); ?>>
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'project-thumb', [ 'class' => 'card-img-top' ] ); ?>
      <?php endif; ?>
      <div class="card-body d-flex flex-column">
        <h2 class="h5 card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
          if ( function_exists('get_field') ) { $type = get_field('projectType'); }
          else { $type = get_post_meta( get_the_ID(), 'projectType', true ); }
          if ( $type ) { echo '<p class="badge bg-primary" mb-3">' . esc_html( $type ) . '</p>'; }
        ?>
        <p class="card-text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt(), true ) ); ?></p>
        <div class="mt-auto">
          <a class="btn btn-outline-primary btn-sm" href="<?php the_permalink(); ?>"><?php esc_html_e('View project', 'devfolio'); ?></a>
        </div>
      </div>
    </article>
  </div>
<?php endwhile; endif; ?>
</div>

<?php devfolio_pagination(); ?>

<?php get_footer(); ?>
