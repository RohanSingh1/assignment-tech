<?php
/**
 * The Register Acf Blocks
 *
 * @package assessment
 */

 function assessment_register_block_categories( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'assessment-block',
				'title' => 'Assessment Blocks',
			),
		)
	);
}
add_action( 'block_categories_all', 'assessment_register_block_categories', 10, 2 );


add_action( 'acf/init', 'assessment_acf_init_blocks' );
function assessment_acf_init_blocks() {

	// Check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		acf_register_block_type(
			array(
				'name'            => 'home-banner',
				'title'           => 'Assessment: Home Banner',
				'description'     => 'assessment: Home Banner',
				'render_template' => 'inc/blocks/home-banner.php',
				'category'        => 'assessment-block',
				'icon'            => 'assessment-block-icon',
			)
		);
		
	}
	
}
