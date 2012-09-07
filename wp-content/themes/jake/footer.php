<?php roots_footer_before(); ?>
  <footer id="footer" class="row">
    <?php roots_footer_inside(); ?>
    <div class="container">
      <div class="row">
        <div class="span6">
          <?php //get_template_part('templates/nav', 'utility'); ?>
          <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
        <div class="span6">
          <?php //get_template_part('templates/nav', 'sitemap'); ?>
        </div>
      </div>
    </div>
  </footer>
  <?php roots_footer_after(); ?>

  <?php wp_footer(); ?>
  <?php roots_footer(); ?>

</body>
</html>