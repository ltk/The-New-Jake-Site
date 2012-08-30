<h2 class="section-title"><?php echo $post->post_title ?></h2>

<div class="sidebar-content-box-wrapper">
  <div class="sidebar-content-box">
    <?php echo Jake::get_post_featured_image_for( $post, 'program-thumbnail', 'full' ); ?>
  </div>
</div>
<?php // dynamic_sidebar('sidebar-primary'); ?>