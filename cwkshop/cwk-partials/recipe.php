<?php
/**
 * Recipe tab on products.
 *
 * @author 		LSpeight
 * @version     2.0.0
 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $woocommerce, $post;

	$rr = get_post_meta($post->ID,'related-recipes',true);
	if ($rr) {
		echo '<h2>Related Recipes</h2>';

		$rr_out = apply_filters('the_content',$rr);	
		echo '<div class="recipe-tab zig">'.$rr_out.'</div>';
	} else {
		echo 'No recipes found.';
	}

	/* echo '<p class="recipe-tab" >'.$rr_out.'</p>'; */


?>