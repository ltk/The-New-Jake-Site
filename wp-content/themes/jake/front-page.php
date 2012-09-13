<?php get_header(); ?>

		<script data-template-name="client" type="text/x-handlebars">
			<h1>{{view.content.title}}</h1>
			<p>{{view.content.text}}</p>
		</script>

		<script data-template-name="next-button" type="text/x-handlebars">
			Go to Next Slide
		</script>
		<script data-template-name="prev-button" type="text/x-handlebars">
			Go to Previous Slide
		</script>






	<?php

	//roots_marquee_before();
		//get_template_part('templates/elements', 'marquee');
	//roots_marquee_after();

	?>

	<?php //roots_content_before(); ?>
	<div id="featured-work">

		<!-- We might want to add the scroll divs with JS, or at least hide them with the .no-js class -->

<!-- 		<?php
		$case_studies = new CaseStudyController();
		echo $case_studies->output_homepage_list();
		?> -->
	</div>
	<div id="featured-clients">
	</div>


	<div id="content" class="container">
		<div class="row">
			<div class="span12">Other stuff goes here.</div>	
		</div>
	</div>
	
	<?php //roots_content_after(); ?>

<?php get_footer(); ?>