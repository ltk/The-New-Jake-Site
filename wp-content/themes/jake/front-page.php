<?php get_header(); ?>

	<?php

	//roots_marquee_before();
		//get_template_part('templates/elements', 'marquee');
	//roots_marquee_after();

	?>

	<?php //roots_content_before(); ?>
	<div id="featured-work">
		<!-- We might want to add the scroll divs with JS, or at least hide them with the .no-js class -->
		<a class="scroll-left" href="#" title="Previous Case Study">Previous Case Study</a>
		<a class="scroll-right" href="#" title="Next Case Study">Next Case Study</a>

		<ol>
			<li class="kennedy-center">
				<div class="inner">
					<h1>Slide Title for This Client</h1>
					<p>Some text <a href="#" title="#">and a link</a>.</p>
				</div>
			</li>
			<li>
				<div class="inner">
					<h1>Slide Title for That Client</h1>
					<p>Some text <a href="#" title="#">and a link</a>.</p>
				</div>
			</li>
		</ol>
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