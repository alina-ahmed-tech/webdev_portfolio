<?php
/**
 * Content fallback used by index.php
 *
 * @package devfolio
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
  <header class="mb-2"><h2 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></header>
  <div><?php the_excerpt(); ?></div>
</article>
