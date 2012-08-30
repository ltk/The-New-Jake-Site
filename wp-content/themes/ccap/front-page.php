<?php get_header(); ?>

	<?php

	roots_marquee_before();
		get_template_part('templates/elements', 'marquee');
	roots_marquee_after();

	?>

	<?php roots_content_before(); ?>

	<div id="content" class="container">

			<div class="row">
				<div class="span12 clearfix connect">
					<h4 class="pull-left">CONNECT WITH US</h4>
					<ul class="horizontal-list pull-left social-icons">
						<li><a class="social-icon-facebook" href="http://www.facebook.com/pages/The-Center-For-Clean-Air-Policy/142779552502633" target="_blank" title="CCAP on Facebook">Facebook</a></li>
						<li><a class="social-icon-twitter" href="https://twitter.com/cleanairpolicy" target="_blank" title="CCAP on Twitter">Twitter</a></li>
						<li><a class="social-icon-linkedin" href="http://www.linkedin.com/company/center-for-clean-air-policy" target="_blank" title="CCAP on LinkedIn">LinkedIn</a></li>
					</ul>
					<form method="post" id="newsletter-signup" class="form-newsletter-signup pull-left" action="<?php echo home_url('/'); ?>">
					  <label class="hide-text" for="email">Join our Mailing List</label>
					  <input type="text" value="" name="email" id="email" class="email-signup" placeholder="Join Our Mailing List">
					  <button type="submit" id="signupsubmit" class="btn">Sign Up</button>
					</form>
				</div>
				<div class="widget-area span7" id="widget-area-1">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page: Left')) : ?>
						<!-- Default if No Widgets -->
						<ul class="nav nav-tabs" id="myTab">
							<li class="active"><a href="#spotlight" data-toggle="tab">Spotlight</a></li>
							<li><a href="#news" data-toggle="tab">News &amp; Events</a></li>
							<li><a href="#blog" data-toggle="tab">Blog</a></li>
						</ul>
						 
						<div class="tab-content">
							<div class="tab-pane active" id="spotlight">
								<img src="http://placekitten.com/220/160" class="pull-right" />
								<h2>Inspiring Sessions &amp; Real Action</h2>
								<p>CCAP President Ned Helme reflects on the third Latin American MAIN dialogue through a blog series that targets financing options developing countries use to implement policies and projects that reduce green house gas emissions. </p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed suscipit orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#" class="" title="#">learn more &raquo;</a></p>
							</div>
							<div class="tab-pane" id="news">
								<img src="http://placekitten.com/220/130" class="pull-right" />
								<h2>Second Title</h2>
								<p>CCAP President Ned Helme reflects on the third Latin American MAIN dialogue through a blog series that targets financing options developing countries use to implement policies and projects that reduce green house gas emissions. </p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed suscipit orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#" class="" title="#">learn more &raquo;</a></p>
							</div>
							<div class="tab-pane" id="blog">
								<img src="http://placekitten.com/220/180" class="pull-right" />
								<h2>Third Title</h2>
								<p>CCAP President Ned Helme reflects on the third Latin American MAIN dialogue through a blog series that targets financing options developing countries use to implement policies and projects that reduce green house gas emissions. </p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed suscipit orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#" class="" title="#">learn more &raquo;</a></p>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="widget-area span5" id="widget-area-2">
					<div id="where-we-work">
						<a href="#" class="map-dot-1 map-dot" rel="popover" data-title="Alaska" data-content="Donec dignissim consectetur iaculis. Donec auctor commodo posuere. Vestibulum ante ipsum primis."></a>
						<a href="#" class="map-dot-2 map-dot" rel="popover" data-title="Florida" data-content="Donec dignissim consectetur iaculis. Donec auctor commodo posuere. Vestibulum ante ipsum primis."></a>
						<a href="#" class="map-dot-3 map-dot" rel="popover" data-title="Greenland" data-content="Donec dignissim consectetur iaculis. Donec auctor commodo posuere. Vestibulum ante ipsum primis."></a>
						<a href="#" class="map-dot-4 map-dot" rel="popover" data-title="Côte d'Ivoire" data-content="Donec dignissim consectetur iaculis. Donec auctor commodo posuere. Vestibulum ante ipsum primis."></a>
						<a href="#" class="map-dot-5 map-dot" rel="popover" data-title="Nepal" data-content="Donec dignissim consectetur iaculis. Donec auctor commodo posuere. Vestibulum ante ipsum primis."></a>
						<a href="#" class="map-dot-6 map-dot" rel="popover" data-title="Siberia" data-content="Donec dignissim consectetur iaculis. Donec auctor commodo posuere. Vestibulum ante ipsum primis."></a>

						<img src="/img/world-map.png" alt="#" />
						<h3>Where We Work</h3>
						<p>CCAP is a worldwide leader in developing and implementing market-based solutions.</p>
					</div>
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page: Right')) : ?>
						<!-- Default if No Widgets -->
					<?php endif; ?>
				</div>
			</div>



			<div class="widget-area span12" id="widget-area-3">
				<div class="row">
				<div id="recent-publications" class="span12">
					<h6>RECENT PUBLICATIONS</h6>
					<div class="row horizontal-list clearfix">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page: Bottom')) : ?>
					<!-- Default if No Widgets -->
				<?php endif; ?>
					</div>
				</div>
				</div>
			</div>
	</div>
	
	<?php roots_content_after(); ?>

<?php get_footer(); ?>