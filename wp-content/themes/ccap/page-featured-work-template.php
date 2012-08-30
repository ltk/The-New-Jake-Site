<?php
/*
Template Name: Featured Work
*/

$template_options = array(
  'sidebar' => 'work',
  'after_loop' => Jake::get_featured_work()
  );

// This render function fills customizations into master-template.php
Jake::render_template( $template_options );

?>