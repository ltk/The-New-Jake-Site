<?php
$template_options = array(
  'sidebar' => 'person',
  'sidebar_class' => 'person',
  'loop' => 'person',
  'sidebar_box_contents' => Jake::get_post_featured_image_for( $post, 'staff-portrait', 'full' )
  );

// This render function fills customizations into master-template.php
Jake::render_template( $template_options );

?>