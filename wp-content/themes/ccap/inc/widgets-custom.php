<?php
function jake_widgets_init() {
	register_sidebar(array(
		'name' => __('Home Page: Left', 'roots'),
		'id' => 'homepage-1',
		'description' => 'This is the area on the left side of the homepage.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => __('Home Page: Right', 'roots'),
		'id' => 'homepage-2',
		'description' => 'This is the area on the right side of the homepage.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => __('Home Page: 3', 'roots'),
		'id' => 'homepage-3',
		'description' => 'This is the area on the bottom half of the home page, in the gray box.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => __('Home Page: Bottom', 'roots'),
		'id' => 'homepage-4',
		'description' => 'This is the area on the bottom of the home page, just above the footer.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));


	register_widget('Jake_Graphic_Widget');
	register_widget('Jake_Twitter_Widget');
	register_widget('Jake_Text_Widget');
}
add_action('widgets_init', 'jake_widgets_init');

/**
	Graphic Widget
*/
class Jake_Graphic_Widget extends WP_Widget {
	function flush_widget_cache() {
		wp_cache_delete('Jake_Graphic_Widget', 'widget');
	}

	function Jake_Graphic_Widget() {
		$widget_ops = array('classname' => 'Jake_Graphic_Widget', 'description' => __('Use this widget to add a featured link with a graphic and description.', 'roots'));
		$this->WP_Widget('Jake_Graphic_Widget', __('Graphic Widget', 'roots'), $widget_ops);
		$this->alt_option_name = 'Jake_Graphic_Widget';

		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

	function widget($args, $instance) {
		$args = array(
			'numberposts' => 3,
			'post_type' => 'resource',
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'tax_query' => array(
					array(
						'taxonomy' => 'resource-type',
						'field' => 'slug',
						'terms' => 'document'
					)
				)
			);
		$docs_array = get_posts( $args );
		foreach($docs_array as $doc):

			setup_postdata($doc);
			?>
			<div class="widget graphic-widget span4 clearfix">     
				<a href="<?php echo get_permalink($doc->ID); ?>" title="<?php echo $doc->post_title; ?>"><?php echo get_the_post_thumbnail($doc->ID, 'full', array('class' => 'pull-left')); ?></a>
				<a href="<?php echo get_permalink($doc->ID); ?>" title="<?php echo $doc->post_title; ?>"><h4 class="main-font"><?php echo date('F j, Y', strtotime($doc->post_date)); ?></h4></a>
				<p><?php echo $doc->post_title; ?></p>
			</div>
			<?php
			endforeach;
		// endwhile;
	?>
<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description']);
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['graphic'] = strip_tags($new_instance['graphic']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if (isset($alloptions['Jake_Graphic_Widget'])) {
			delete_option('Jake_Graphic_Widget');
		}

		return $instance;
	}

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$description = isset($instance['description']) ? esc_attr($instance['description']) : '';
		$link = isset($instance['link']) ? esc_attr($instance['link']) : '';
		$graphic = isset($instance['graphic']) ? esc_attr($instance['graphic']) : '';

	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php _e('Description:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" type="text" value="<?php echo esc_attr($description); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php _e('Link:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('graphic')); ?>"><?php _e('Graphic:', 'roots'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('graphic')); ?>" id="<?php echo esc_attr($this->get_field_id('graphic')); ?>">
				<option value="capitol" <?php echo tjg_input_check($graphic, 'capitol', 'select'); ?>>Capitol</option>
				<option value="bullhorn" <?php echo tjg_input_check($graphic, 'bullhorn', 'select'); ?>>Bullhorn</option>
				<option value="nodes" <?php echo tjg_input_check($graphic, 'nodes', 'select'); ?>>Nodes</option>
			</select>
		</p>

<?php
	}
}

/** 
	End Graphic Widget


	Begin Twitter Widget
*/
	
class Jake_Twitter_Widget extends WP_Widget {
	private $username;
	private $count;


	function flush_widget_cache() {
		wp_cache_delete('Jake_Twitter_Widget', 'widget');
	}
	
	function Jake_Twitter_Widget() {
		$widget_ops = array('classname' => 'Jake_Twitter_Widget', 'description' => __('Use this widget to display your most recent tweets.', 'roots'));
		$this->WP_Widget('Jake_Twitter_Widget', __('Twitter Widget', 'roots'), $widget_ops);
		$this->alt_option_name = 'Jake_Twitter_Widget';

		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

	function tweets() {
		//SETUP FEED
		include_once(ABSPATH . WPINC . '/feed.php');
		$twitter_rss = "http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=".$this->username."&count=".$this->count;
		$rss = fetch_feed($twitter_rss);

		if ( is_wp_error( $rss ) ) {
			$wholetweet = 'The connection to twitter has returned an error. Please try again later.<br />';
		} else {

			$maxitems = $rss->get_item_quantity($this->count);
			$rss_items = $rss->get_items(0, $maxitems);
			return $rss_items;
		}
	}

	function when($tweet) {
		$tprefix = '';
		$tsecs = 'seconds';
		$tmin = 'minutes';
		$tmins = 'minutes';
		$thour = 'hour';
		$thours = 'hours';
		$tday = 'day';
		$tdays = 'days';
		$tsuffix = 'ago';


		$now = time();
		
		$when = ($now - strtotime($tweet->get_date()));
		$posted = "";
		
		if ($when < 60) {
			$posted = $tprefix." ".$when." ".$tsecs." ".$tsuffix;
		}
		if (($posted == "") & ($when < 3600)) {
			$posted = $tprefix." ".(floor($when / 60))." ".$tmins." ".$tsuffix;
		}
		if (($posted == "") & ($when < 7200)) {
			$posted = $tprefix." 1 ".$thour." ".$tsuffix;
		}
		if (($posted == "") & ($when < 86400)) {
			$posted = $tprefix." ".(floor($when / 3600))." ".$thours." ".$tsuffix;
		}
		if (($posted == "") & ($when < 172800)) {
			$posted = $tprefix." 1 ".$tday." ".$tsuffix;
		}
		if ($posted == "") {
			$posted = $tprefix." ".(floor($when / 86400))." ".$tdays." ".$tsuffix;
		}
		
		return $posted;
	}

	function widget($args, $instance) {
		$this->username = isset($instance['user']) ? esc_attr($instance['user']) : 'firststreet';
		$this->count = isset($instance['tweetnumber']) ? esc_attr($instance['tweetnumber']) : 1;
?>
		<div class="widget large twitter-widget">
			<img src="<?php echo get_template_directory_uri(); ?>/img/twitter-icon.png" alt="Twitter" class="twitter-logo" />
			<div class="twitter-info">
				<?php
				$tweets = $this->tweets();
				foreach($tweets as $tweet) {
					$tweet_text = preg_replace("/(@[^\s]+)/i", "<span class='twitter-user'>$1</span>", $tweet->get_title());
					$tweet_text = preg_replace("/(#[^\s]+)/i", "<span class='twitter-meme'>$1</span>", $tweet_text);
					$tweet_text = preg_replace("/(http:\/\/[^\s]+)/i", "<a class='twitter-link' href='$1' target='_blank'>$1</a>", $tweet_text);
					echo "<div class='tweet-info pull-right'>" . $this->when($tweet) . " / <a href='http://twitter.com/home?status=RT " . str_replace($this->username . ": ", "@" . $this->username . " ", $tweet->get_title()) . "' target='_blank'>retweet</a><span></div><p class='tweet'>" . str_replace($this->username . ': ', '', $tweet_text) . "</p>";
				}
				?>
			</div>
		</div>
<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['user'] = strip_tags($new_instance['user']);
		//$instance['password'] = strip_tags($new_instance['password']);
		$instance['tweetnumber'] = strip_tags($new_instance['tweetnumber']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if (isset($alloptions['Jake_Twitter_Widget'])) {
			delete_option('Jake_Twitter_Widget');
		}

		return $instance;
	}

	function form($instance) {
		$user = isset($instance['user']) ? esc_attr($instance['user']) : '';
		$password = isset($instance['password']) ? esc_attr($instance['password']) : '';
		$tweetnumber = isset($instance['tweetnumber']) ? esc_attr($instance['tweetnumber']) : '';

	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('user')); ?>"><?php _e('Username:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('user')); ?>" name="<?php echo esc_attr($this->get_field_name('user')); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tweetnumber')); ?>"><?php _e('# of Tweets:', 'roots'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('tweetnumber')); ?>" id="<?php echo esc_attr($this->get_field_id('tweetnumber')); ?>">
			<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					echo sprintf('<option value="%s" %s>%s</option>',
						$i,
						tjg_input_check($tweetnumber, $i, 'select'),
						$i
					);
				}
			?>
			</select>
		</p>
	<?php
	}
}

/** 
	End Twitter Widget

	Begin Social Widget
*/

class Jake_Social_Widget extends WP_Widget {
	function flush_widget_cache() {
		wp_cache_delete('Jake_Social_Widget', 'widget');
	}
	
	function Jake_Social_Widget() {
		$widget_ops = array('classname' => 'Jake_Social_Widget', 'description' => __('Use this widget to display your most recent tweets.', 'roots'));
		$this->WP_Widget('Jake_Social_Widget', __('Social Media Widget', 'roots'), $widget_ops);
		$this->alt_option_name = 'Jake_Social_Widget';

		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

	function widget($args, $instance) {
?>
		<div class="widget large twitter-widget">
			<img src="<?php echo get_template_directory_uri(); ?>/img/twitter-icon.png" alt="Twitter" class="twitter-logo" />
			<div class="twitter-info">
				<p class="tweet">Lorem ipsum dolor sit amet</p>
				<ul class="tweet-actions teal nav separated-nav">
					<li>36 mins</li>
					<li><a href="#">retweet</a></li>
					<li><a href="#">follow us</a></li>
				</ul>
			</div>
		</div>
<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['user'] = strip_tags($new_instance['user']);
		$instance['password'] = strip_tags($new_instance['password']);
		$instance['tweetnumber'] = strip_tags($new_instance['tweetnumber']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if (isset($alloptions['Jake_Social_Widget'])) {
			delete_option('Jake_Social_Widget');
		}

		return $instance;
	}

	function form($instance) {
		$user = isset($instance['user']) ? esc_attr($instance['user']) : '';
		//$password = isset($instance['password']) ? esc_attr($instance['password']) : '';
		$tweetnumber = isset($instance['tweetnumber']) ? esc_attr($instance['tweetnumber']) : '';

	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('user')); ?>"><?php _e('Username:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('user')); ?>" name="<?php echo esc_attr($this->get_field_name('user')); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('password')); ?>"><?php _e('Password:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('password')); ?>" name="<?php echo esc_attr($this->get_field_name('password')); ?>" type="password" value="<?php echo esc_attr($password); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tweetnumber')); ?>"><?php _e('# of Tweets:', 'roots'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('tweetnumber')); ?>" id="<?php echo esc_attr($this->get_field_id('tweetnumber')); ?>">
			<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					echo sprintf('<option value="%s" %s>%s</option>',
						$i,
						tjg_input_check($tweetnumber, $i, 'select'),
						$i
					);
				}
			?>
			</select>
		</p>
	<?php
	}
}


/** 
	End Social Widget

	Begin Jake Text Widget
*/

class Jake_Text_Widget extends WP_Widget {
	function flush_widget_cache() {
		wp_cache_delete('Jake_Graphic_Widget', 'widget');
	}

	function Jake_Text_Widget() {
		$widget_ops = array('classname' => 'Jake_Text_Widget', 'description' => __('Use this widget to add a text section to a dropdown menu.', 'roots'));
		$this->WP_Widget('Jake_Text_Widget', __('Drop Down Menu Text Widget', 'roots'), $widget_ops);
		$this->alt_option_name = 'Jake_Text_Widget';

		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

		function widget($args, $instance) {
			$this->title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
			$this->content   = isset($instance['content']) ? esc_attr($instance['content']) : '';
			$this->url       = isset($instance['url']) ? esc_attr($instance['url']) : false;
			$this->link_text = isset($instance['link_text']) ? esc_attr($instance['link_text']) : 'Learn More';
	?>
		<li class="widget jake-text-widget">
			<h2><?php echo $this->title; ?></h2>
			<?php
				if ($this->url) { 
					$this->content .= ' <a href="' . $this->url . '">' . $this->link_text . ' &raquo;</a>';
				}
				echo apply_filters( 'the_content', $this->content );
			?>

		</li>
	<?php
		}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title']     = strip_tags($new_instance['title']);
		$instance['content']   = strip_tags($new_instance['content']);
		$instance['url']       = strip_tags($new_instance['url']);
		$instance['link_text'] = strip_tags($new_instance['link_text']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if (isset($alloptions['Jake_Text_Widget'])) {
			delete_option('Jake_Text_Widget');
		}

		return $instance;
		}

	function form( $instance ) {
		$title     = isset( $instance['title'] )     ? esc_attr( $instance['title'] )     : '';
		$content   = isset( $instance['content'] )   ? esc_attr( $instance['content'] )   : '';
		$url       = isset( $instance['url'] )       ? esc_attr( $instance['url'] )       : '';
		$link_text = isset( $instance['link_text'] ) ? esc_attr( $instance['link_text'] ) : 'Learn More';

?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><?php _e('Content:', 'roots'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('content') ); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_attr($content); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('url') ); ?>"><?php _e('URL:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('url') ); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('link_text')); ?>"><?php _e('Link Text:', 'roots'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('link_text')); ?>" name="<?php echo esc_attr($this->get_field_name('link_text')); ?>" type="text" value="<?php echo esc_attr($link_text); ?>" />
		</p>
<?php
	}
}
