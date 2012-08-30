<?php
add_image_size( 'featured-work-thumbnail', 220, 137, true );

// Custom functions
function tjg_input_check( $var, $value, $type ) {
	if ( $var == $value && $type == 'check' ) { return 'checked="checked"'; }
	if ( $var == $value && $type == 'select' ) { return 'selected="selected"'; }
}


