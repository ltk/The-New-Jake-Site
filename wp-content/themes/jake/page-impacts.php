<?php
/*
Template Name: Impacts Timeline
*/

$template_options = array(
  'show_sidebar' => false,
  'after_loop' => Jake::get_timeline()
  );

// This render function fills customizations into master-template.php
Jake::render_template( $template_options );

?>