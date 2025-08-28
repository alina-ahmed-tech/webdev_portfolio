<?php
/**
 * Generic page template
 *
 * @package devfolio
 */
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
    <header class="mb-3">
      <h1 class="h2"><?php the_title(); ?></h1>
    </header>
    <div class="content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
