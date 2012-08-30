<div id="marquee" class="container row">
  	<div id="slides"> 
  		<div class="slide" style=""  data-overlay="#htmlOverlay0">
  			<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
  			<p>Ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pellentesque mauris vitae nisi tristique eu condimentum mi faucibus. Fusce at mauris nec sapien rhoncus fermentum eget ut dolor.</p>
  		</div>
  		<div class="slide" style=""  data-overlay="#htmlOverlay1" style="display:none;">
  			<h1>Dolor sit amet, consectetur adipiscing elit.</h1>
  			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pellentesque mauris vitae nisi tristique eu condimentum mi faucibus. Fusce at mauris nec sapien rhoncus fermentum eget ut dolor.</p>
  		</div>
  		<div class="slide" style=""  data-overlay="#htmlOverlay2" style="display:none;">
  			<h1>Ipsum dolor sit amet, consectetur adipiscing elit.</h1>
  			<p>Dolor sit amet, consectetur adipiscing elit. Pellentesque pellentesque mauris vitae nisi tristique eu condimentum mi faucibus. Fusce at mauris nec sapien rhoncus fermentum eget ut dolor.</p>
  		</div>
  	</div>
  	<!-- Overlays for Orbit -->
  	<div id="overlays">
  		<div class="orbit-overlay" id="htmlOverlay0">
  			<img class="circle" src="/img/marquee/windmills.jpg" alt="Lorem Ipsum" />
  		</div>
  		<div class="orbit-overlay" id="htmlOverlay1">
  			<img class="circle" src="/img/marquee/windmills-2.jpg" alt="Lorem Ipsum" />
  		</div>
  		<div class="orbit-overlay" id="htmlOverlay2">
  			<img class="square" src="/img/marquee/windmills.jpg" alt="Lorem Ipsum" />
  		</div>
  	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#slides').orbit({directionalNav: false, captions: false, advanceSpeed : 6000 });
	});

	// $('#s2').cycle({ 
	//     fx:     'fade', 
	//     speed:  'fast', 
	//     timeout: 0, 
	//     next:   '#next2', 
	//     prev:   '#prev2' 
	// });
</script>