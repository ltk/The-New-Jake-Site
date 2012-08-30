<?php
$template_options = array(
  'loop' => 'single'
  );

// This render function fills customizations into master-template.php
Jake::render_template( $template_options );

	// If comments are open or we have at least one comment, load up the comment template
	// if ( comments_open() || '0' != get_comments_number() )
	// 	comments_template( '', true );

?>