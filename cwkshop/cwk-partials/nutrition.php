<?php
/**
 * Nutrition tab
 *
 * @author 		LSpeight
 * @version     2.0.0
 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $woocommerce, $post;
	$ingred = get_post_meta($post->ID,'product_ingredients',true);
	$nut = get_post_meta($post->ID,'nutrition',true);
	$mofga = get_post_meta($post->ID,'MOFGA',true);
	if ($nut || $ingred || $mofga) {
		if ($ingred) {
			echo '<h2 class="cwk_pingred_heading">Product Ingredients</h2>';
			echo '<p class="cwk_pingred">'.$ingred.'</p>';
		} 
		if ($nut) {
			echo '<h2 class="cwk_nuttab_heading">Nutritional Information</h2>';
			echo '<p class="cwk-nutrition" >'.$nut.'</p>';
		}
		if ($mofga) {
			echo '<p class="cwk_mofga">* Certified Organic by MOFGA</p>';
		}
	}
	

?>