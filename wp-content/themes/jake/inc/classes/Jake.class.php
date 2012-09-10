<?php
class Jake
{

	public static function display_breadcrumbs() {
		if( function_exists( 'bcn_display' ) ) {
		    bcn_display();
		}
	}

	public static function get_case_studies() {

	}
}

class CaseStudyController {
	public $case_studies = array();

	public function __construct() {
		$this->get_case_studies_from_wp();
	}

	private function get_case_studies_from_wp() {
		$args = array(
			'post_type' => 'case-study',
			'order'     => 'ASC',
			'orderby'   => 'menu_order',
			'numberposts' => -1
			);

		$case_studies = get_posts( $args );

		if( ! empty( $case_studies ) ) {
			foreach( $case_studies as $case_study ) {
				array_push( $this->case_studies, $this->create_case_study_from_post( $case_study ) );
			}
		}
	}

	private function create_case_study_from_post( $case_study_post ) {
		$case_study_content = array(
			'image_headline' => get_post_meta( $case_study_post->ID, "wpcf-image-headline", true ),
			'image_subhead' => get_post_meta( $case_study_post->ID, "wpcf-image-subhead", true ),
			'css_class' => get_post_meta( $case_study_post->ID, "wpcf-css-class", true )
			);
		$case_study = new CaseStudy( $case_study_content );
		return $case_study;
	}

	public function output_homepage_list() {
		$output = null;
		if( ! empty( $this->case_studies ) ) {
			foreach( $this->case_studies as $case_study ) {
				$output .= "<li class='{$case_study->css_class}'>"
					. "<div class='inner'>"
					.	"<h1>{$case_study->image_headline}</h1>"
					.	"<p>{$case_study->image_subhead}</p>"
					. "</div>"
				. "</li>";
			}
		}

		return sprintf( '<ol>%s</ol>', $output );
	}
}

class CaseStudy {
	public $image_headline;
	public $image_subhead;
	public $css_class;

	public function __construct( $content_array ) {
		foreach( $content_array as $array_key => $array_value ) {
			$this->$array_key = $array_value;
		}
	}
}
?>