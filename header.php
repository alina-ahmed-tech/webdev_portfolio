<?php
/**
 * Header
 *
 * @package devfolio
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="visually-hidden-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'devfolio' ); ?></a>

<header class="navbar navbar-expand-lg navbar-light bg-light border-bottom py-3">
  <div class="container">
    
    <a class="navbar-brand fw-bold" href="<?php echo esc_url( home_url( '/' ) ); ?>">Alina Ahmed</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'devfolio'); ?>">
      <span class="navbar-toggler-icon"></span>
    </button>
    <nav id="primaryNav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php
        // Define menu items and their page titles
        $menu_items = [
          'About' => 'About',
          'Projects' => 'All Projects', 
          'Blogs' => 'All Blogs', 
          'WordPress Portfolio' => 'WordPress Portfolio', 
        ];

        // Loop through the menu items to generate the links
        foreach ($menu_items as $text => $title) {
          $page = get_page_by_title($title);
          if ($page) {
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($text) . '</a>';
            echo '</li>';
          }
        }
        ?>
      </ul>
    </nav>
  </div>
</header>

<main id="content" class="site-content py-4">
  <div class="container">