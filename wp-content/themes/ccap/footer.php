  <div id="footer-bar" class="row">
    <div class="container">
      <div id="latest-social-update" class="span12">
        <!-- Twitter business goes here. -->
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Top')) : ?>
          <!-- Default if No Widgets -->
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php roots_footer_before(); ?>
  <footer id="footer" class="row">
    <?php roots_footer_inside(); ?>
    <div class="container">
      <div class="row">
        <div class="span6">
          <?php get_template_part('templates/nav', 'utility'); ?>
          <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
        <div class="span6">
          <?php get_template_part('templates/nav', 'sitemap'); ?>
        </div>
      </div>
    </div>
  </footer>
  <?php roots_footer_after(); ?>

  <?php wp_footer(); ?>
  <?php roots_footer(); ?>

</body>
</html>