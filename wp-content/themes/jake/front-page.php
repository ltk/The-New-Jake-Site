<?php get_header(); ?>

	<?php

	roots_marquee_before();
		//get_template_part('templates/elements', 'marquee');
	roots_marquee_after();

	?>

	<?php roots_content_before(); ?>

	<div id="content" class="container">
		<div class="row">
			<div class="span12">Content Goes Here</div>	
		</div>
	</div>
	
	<?php roots_content_after(); ?>

<?php get_footer(); ?>