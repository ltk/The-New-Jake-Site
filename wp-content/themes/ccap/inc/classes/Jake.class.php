<?php
class Jake
{

	public static function display_breadcrumbs() {
		if( function_exists( 'bcn_display' ) ) {
		    bcn_display();
		}
	}

	public static function get_related_objects( $original_post, $object_type, $params = null ) {
	  $original_post_slug = basename(get_permalink( $original_post->ID ) );

	  switch( $object_type ) {
	    case 'documents':
	      $query_args = array(
	        'order'    => 'DESC',
	        'post_type' => 'resource',
	        'tax_query' => array(
	          array(
	            'taxonomy' => 'related-programs',
	            'field'    => 'slug',
	            'terms'    => $original_post_slug
	          ),
	          array(
	            'taxonomy' => 'resource-type',
	            'field'    => 'slug',
	            'terms'    => 'document'
	          )
	        )
	      );
	      $related_objects = get_posts( $query_args );
	      return self::get_related_objects_html( $related_objects, $object_type, $params );
	      break;

	    case 'links':
	      $query_args = array(
	        'order'    => 'DESC',
	        'post_type' => 'resource',
	        'tax_query' => array(
	          array(
	            'taxonomy' => 'related-programs',
	            'field'    => 'slug',
	            'terms'    => $original_post_slug
	          ),
	          array(
	            'taxonomy' => 'resource-type',
	            'field'    => 'slug',
	            'terms'    => 'link'
	          )
	        )
	      );
	      $related_objects = get_posts( $query_args );
	      return self::get_related_objects_html( $related_objects, $object_type, $params );
	      break;

	    case 'topics':
	      $related_objects = get_the_tags( $original_post->ID );
	      return self::get_related_objects_html( $related_objects, $object_type, $params );
	      break;

	    case 'news':
	      $query_args = array(
	        'order'    => 'DESC',
	        'post_type' => 'post',
	        'tax_query' => array(
	          array(
	            'taxonomy' => 'related-programs',
	            'field'    => 'slug',
	            'terms'    => $original_post_slug
	          )
	        )
	      );
	      $related_objects = get_posts( $query_args );
	      return self::get_related_objects_html( $related_objects, $object_type, $params );
	      break;
	  }
	  return false;
	}

	public static function get_related_objects_html( $related_objects, $object_type, $params = null ) {
	  $objects_template = ( isset( $params['objects_template'] ) ) ? $params['objects_template'] : "<div class='related-$object_type'><h4><i class='icon-book icon-white'></i> RELATED $object_type</h4><ul class='$object_type'>%s</ul></div>";

	  $output = null;

	  foreach( $related_objects as $related_object ) {
	    $output .= self::get_related_object_html( $related_object, $object_type, $params );
	  }

	  $output = sprintf( $objects_template, $output );
	  return $output;
	}

	public static function get_related_object_html( $related_object, $object_type, $params = null) {
	  $object_template = ( isset( $params['object_template'] ) ) ? $params['object_template'] : "<li class='$object_type'>%s</li>";

	  switch( $object_type ) {
	    case 'topics':
	      $output = "<a href='#' title='" . $related_object->name . "' target='_blank'>" . $related_object->name . "</a>";
	      break;

	    default:
	      $output = "<a href='" . get_permalink( $related_object->ID ) . "' title='" . $related_object->post_title . "'>" . $related_object->post_title . "</a>";
	      break;
	  }

	  $output = sprintf( $object_template, $output );

	  return $output;
	}

	public static function get_excerpt_for( $this_post ){
		$the_excerpt = $this_post->post_content; //Gets post_content to be used as a basis for the excerpt
		$excerpt_length = 25; //Sets excerpt length by word count
		$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
		$words = explode(' ', $the_excerpt, $excerpt_length + 1);
		
		if(count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words, '…');
			$the_excerpt = implode(' ', $words);
		endif;

		$the_link = "<a href='" . get_permalink( $this_post->ID ) . "' title='Read more: " . $this_post->post_title . "'>learn more</a>";

		$the_excerpt = '<p>' . $the_excerpt . ' ' . $the_link . '</p>';

		return $the_excerpt;
	}

	public static function get_post_featured_image_for( $this_post, $image_class, $image_size, $link_photo = false ) {
	  if ( has_post_thumbnail( $this_post->ID ) ) {
	    
	    $attr = array(
	      'class' => $image_class,
	      'alt' => $this_post->post_title,
	      'title' => $this_post->post_title
	      );
	    $size = $image_size;

	    $photo = get_the_post_thumbnail( $this_post->ID, $size, $attr );
	    
	    if( $photo && $link_photo ) {
	    	return "<a href='" . get_permalink( $this_post->ID ) . "' title='" . $this_post->post_title . "'>" . $photo . "</a>";
	    } else {
	    	return $photo;
	    }
	  }
	  return false;
	}

	public static function get_featured_work() {
	  $args = array(
	    'order'    => 'DESC',
	    'tag' => 'featured',
	    'post_type' => array('programs', 'post')
	  );

	  $featured_posts = get_posts( $args );

	  $output = "";

	  foreach( $featured_posts as $featured_post ) {
	    $output .= self::get_featured_post_entry( $featured_post );
	  }

	  $output = sprintf( "<ul class='featured-work'>%s</ul>", $output );

	  return $output;
	}

	public static function get_featured_post_entry( $featured_post ) {
	  $output = "<h2><a href='" . get_permalink( $featured_post->ID ) . "' title='" . $featured_post->post_title . "'>" . $featured_post->post_title . "</a></h2>";
	  $output .= self::get_post_featured_image_for( $featured_post, 'featured-post-thumbnail', 'featured-work-thumbnail', true );
	  $output .= self::get_excerpt_for( $featured_post );

	  $output = sprintf( "<li class='clearfix'>%s</li>", $output );

	  return $output;
	}

	public static function get_staff_list() {
		$staff_categories = get_terms( 'staff-group', 'hide_empty=1&parent=12' );

		$output = null;

		foreach( $staff_categories as $category ) {
			$output .= self::get_category_entry( $category->slug, $category->name );
		}

		return $output;
	}

	public static function get_category_entry( $category_slug, $category_name ) {
		$args = array(
			'post_type' => 'people',
			'order'     => 'ASC',
			'tax_query' => array(
					array(
						'taxonomy' => 'staff-group',
						'field'    => 'slug',
						'terms'    => $category_slug
					)
				)
		);

		$staff_members = get_posts( $args );


		$output = '<div class="staff row"><h4 title="'.$category_name.'">'.$category_name.'</h4>';

		foreach( $staff_members as $person ) {
			$output .= self::get_staff_entry( $person );
		}

		$output .= "</div>";

		return $output;
	}

	public static function get_staff_entry( $person ) {
	  $output  = null;
	  $photo   = self::get_post_featured_image_for( $person, 'staff-thumbnail', array(100,110) );

	  $output .= '<div class="staff-member ' . ( $photo ? '' : 'no-image' ) . '">' 
	                  . ( $photo ? '<a class="staff-thumbnail-link" href="' . get_permalink( $person->ID ) .'">' . $photo . '</a>' : "" ) 
	                  . '<div class="staff-info"><a href="'
	                  . get_permalink( $person->ID )
	                  . '">'
	                  . $person->post_title 
	                  . '</a><span>'
	                  . get_post_meta( $person->ID, "wpcf-title", true )
	                  . "</span></div></div>";
	  return $output;
	}

	public static function render_template( $template_options, $template_name = 'master-template' ) {
		$template_directory = get_template_directory();

		require( $template_directory . '/' . $template_name . '.php' );
	}

	public static function get_timeline() {
		$template_directory = get_template_directory_uri();
			$output = "<script src='http://cloud.github.com/downloads/emberjs/ember.js/ember-0.9.6.min.js'></script>
		<script src='$template_directory/js/timeline/app.js'></script>";
		$output .= <<<html
		<div id="timeline">
		  <script type="text/x-handlebars" data-template-name="dot">
		    {{#if content.showShortTitle }}
		    <span class='shortTitle'>{{content.year}}: {{content.shortTitle}}</span>
		    {{/if}}
		    {{#if content.showYear }}
		    <span class='year'>{{content.year}}</span>
		    {{/if}}
		    <div {{bindAttr style="content.style"}}></div>
		</script>
		<div id="grey-bar"></div>
		<script type="text/x-handlebars" data-template-name="entry">
		  <div {{bindAttr style="content.color_style"}} {{bindAttr class="content.position"}} {{action "showEntry" on="click" target="Timeline.dotsController"}}>
		    <h4>{{content.month}} {{content.year}}</h4>
		    <h1>{{content.title}}</h1>
		    <img {{bindAttr src="content.imageURL"}} class="event-image" alt="Logo">
		    <p>{{content.text}}</p>
		  </div>
		</script>


		</div><!-- #timeline -->
		<script type="text/x-handlebars">
		<div class="event-nav">
		{{view Timeline.PrevButton}}
		{{view Timeline.NextButton}}
		</div>
		</script>
html;
			
		return $output;
	}
}
?>