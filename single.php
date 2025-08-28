<?php
/**
 * Single post
 *
 * @package devfolio
 */
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
    <header class="mb-3">
      <h1 class="display-6"><?php the_title(); ?></h1>
      <p class="post-meta small mb-0">
        <?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?>
      </p>
    </header>
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="mb-3">
        <?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid rounded' ] ); ?>
      </figure>
    <?php endif; ?>
    <div class="content">
      <?php the_content(); ?>
    </div>
    <hr class="my-4">

  <div class="d-flex justify-content-between">
    <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'All Blogs' ) ) ); ?>" 
      class="btn btn-primary">
      ← Back to All Blogs
    </a>
  </div>

  </article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
