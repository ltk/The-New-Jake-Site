<?php
$sidebar_bottom = '<div class="related-content">'
                . Jake::get_related_objects( $post, 'topics' )
                . Jake::get_related_objects( $post, 'documents' )
                . Jake::get_related_objects( $post, 'links' )
                . Jake::get_related_objects( $post, 'news' )
                . '</div>';

$template_options = array(
  'sidebar' => 'work',
  'sidebar_box_contents' => Jake::get_post_featured_image_for( $post, 'program-thumbnail', 'full' ),
  'sidebar_bottom' => $sidebar_bottom
  );

// This render function fills customizations into master-template.php
Jake::render_template( $template_options );

?>