<?php
/**
 * Front page (About as homepage)
 *
 * @package devfolio
 */
get_header();
?>

<div class="row g-4">
  <div class="col-lg-8">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-3">
          <h1 class="display-5">Hello, I'm Alina!</h1>
        </header>
        <div class="content lead">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </div>
  <aside class="col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h2 class="h5"><?php esc_html_e( 'Quick Links', 'devfolio' ); ?></h2>
        <ul class="list-unstyled mb-0">
          <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All Blogs', 'devfolio' ); ?></a></li>
          <?php
          $projects_page = get_page_by_title( 'All Projects' );
          if ( $projects_page ) {
            echo '<li><a href="' . esc_url( get_permalink( $projects_page->ID ) ) . '">' . esc_html__( 'All Projects', 'devfolio' ) . '</a></li>';
          }
          $wp_portfolio = get_page_by_title( 'WordPress Portfolio' );
          if ( $wp_portfolio ) {
            echo '<li><a href="' . esc_url( get_permalink( $wp_portfolio->ID ) ) . '">' . esc_html__( 'WordPress Portfolio', 'devfolio' ) . '</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </aside>
</div>

<?php get_footer(); ?>
