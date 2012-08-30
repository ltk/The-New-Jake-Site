<?php
/*
Template Name: Our Staff
*/

$template_options = array(
	'after_loop' => Jake::get_staff_list()
	);

// This render function fills customizations into master-template.php
Jake::render_template( $template_options );

?>
