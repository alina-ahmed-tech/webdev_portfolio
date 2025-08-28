<?php
/**
 * Single Project
 *
 * @package devfolio
 */
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
    <header class="mb-3">
      <h1 class="display-6"><?php the_title(); ?></h1>
      <?php if ( function_exists('get_field') ) :
        $type = get_field('projectType');
      else :
        $type = get_post_meta( get_the_ID(), 'projectType', true );
      endif; ?>
      <?php if ( $type ) : ?>
        <p class="badge bg-primary"><?php echo esc_html( $type ); ?></p>
      <?php endif; ?>
    </header>
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="mb-3">
        <?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid rounded' ] ); ?>
      </figure>
    <?php endif; ?>
    <div class="content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
