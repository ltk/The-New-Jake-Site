<?php get_header(); ?>

		<script data-template-name="works" type="text/x-handlebars">
			<div class="inner">
				<div class="content">
					<h1>{{view.content.title}}</h1>
					<p>{{view.content.text}}</p>
				</div>
			</div>
		</script>

		<script data-template-name="logos" type="text/x-handlebars">
			<p>{{view.content.img}}</p>
		</script>

	<?php

	//roots_marquee_before();
		//get_template_part('templates/elements', 'marquee');
	//roots_marquee_after();

	?>

	<?php //roots_content_before(); ?>

	<script type="text/x-handlebars">
		{{view Ember.ContainerView currentViewBinding="Banner.Container"}}
	</script>


	<div id="content" class="container">
		<div class="row">
			<div class="span12">Other stuff goes here.</div>	
		</div>
	</div>
	
	<?php //roots_content_after(); ?>

<?php get_footer(); ?>