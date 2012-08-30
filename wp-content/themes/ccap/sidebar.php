<h2 class="section-title"><?php echo get_the_title($post->post_parent); ?></h2>
<?php 
do_action('gk-menu', array('menu' => "Sidebar Navigation", 'start_from' => 'top', 'depth' => 1, 'menu_class' => 'sidebar-nav'));
?>
<?php // dynamic_sidebar('sidebar-primary'); ?>