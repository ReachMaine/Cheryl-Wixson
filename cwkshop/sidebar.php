<?php
/**
 * The Sidebar containing the post widget areas.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */

global $post;

// TESTING
//echo "POSTID: ".$post->ID;

$custom = get_post_custom($post->ID);
$prefix = "dessky_";
$defaultsidebar = "post-sidebar";
$postsidebar = (isset($custom[$prefix."sidebar"][0]) && !is_search())? $custom[$prefix."sidebar"][0] : $defaultsidebar;
$postsidebar  = "post-sidebar";
?>
<div class="widget-area">
	<?php if ( ! dynamic_sidebar( $postsidebar ) ) : ?><?php endif; // end general widget area ?>
</div>
