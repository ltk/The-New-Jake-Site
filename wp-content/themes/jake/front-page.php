<?php get_header(); ?>

		<script type="text/x-handlebars" data-template-name="client">
			<h1>{{view.content.title}}</h1>
			<p>{{view.content.text}}</p>
		</script>

		<script type="text/x-handlebars" data-template-name="next-button">
			{{view.content}}
		</script>
		<script type="text/x-handlebars" data-template-name="prev-button">
			{{view.content}}
		</script>






	<?php

	//roots_marquee_before();
		//get_template_part('templates/elements', 'marquee');
	//roots_marquee_after();

	?>

	<?php //roots_content_before(); ?>
	<div id="featured-work">

		<!-- We might want to add the scroll divs with JS, or at least hide them with the .no-js class -->

		<?php
		$case_studies = new CaseStudyController();
		echo $case_studies->output_homepage_list();
		?>
	</div>
	<div id="featured-clients">
		<ol class="inner">
			<li>
				<a href="#kennedy-center" title="This Client">
					<img src="/img/clients/kennedy-center/logo-white.png" alt="Kennedy Center Logo" />
				</a>
			</li>
			<li>
				<a href="#westview-press" title="That Client">
					<img src="/img/clients/westview-press/logo-white.png" alt="Westview Press Logo" />
				</a>
			</li>
		</ol>
	</div>


	<div id="content" class="container">
		<div class="row">
			<div class="span12">Other stuff goes here.</div>	
		</div>
	</div>
	
	<?php //roots_content_after(); ?>

<?php get_footer(); ?>