<?php
/**
 * Footer
 *
 * @package devfolio
 */
?>
  </div></main>

<footer class="text-light py-4 mt-auto">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
    <div class="small d-flex gap-3">
      <a href="mailto:alina.144.132@gmail.com" class="text-light">
        <i class="fas fa-envelope me-1"></i> Email
      </a>
      <a href="https://www.linkedin.com/in/alina-ahmed-tech/" class="text-light">
        <i class="fab fa-linkedin me-1"></i> LinkedIn
      </a>
      <a href="https://github.com/alina-ahmed-tech" class="text-light">
        <i class="fab fa-github me-1"></i> GitHub
      </a>
    </div>

    <nav aria-label="<?php esc_attr_e('Footer', 'devfolio'); ?>">
      <?php
      wp_nav_menu( [
        'theme_location' => 'footer',
        'container'      => false,
        'menu_class'     => 'nav',
        'fallback_cb'    => false,
        'depth'          => 1,
      ] );
      ?>
    </nav>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>