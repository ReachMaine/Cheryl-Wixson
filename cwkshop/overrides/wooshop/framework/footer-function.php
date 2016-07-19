<?php 
/* 19Nov15 zig - add cfasynch to header slideshow script  */
// print javascript in the <head />
if(!function_exists("dessky_print_javascript")){
	function dessky_print_javascript(){
	

?>
<!-- Hook Flexslider Home Page -->
<script data-cfasync="false" type="text/javascript">
jQuery(window).load(function() {
<?php 
if(is_front_page()){
$disableSlider = of_get_option('dessky_disable_slider' ,'');
if($disableSlider!=true){
$sliderEffect = of_get_option('dessky_slider_effect' ,'fade'); 
$sliderInterval = of_get_option('dessky_slider_interval' ,600);
$sliderDisableNav = of_get_option('dessky_slider_disable_nav');

?>
    jQuery('.flexslider').flexslider({
          animation: "<?php echo $sliderEffect; ?>",
		  animationDuration: <?php echo $sliderInterval; ?>,
		  controlNav: <?php if($sliderDisableNav==true){echo "false";}else{echo "true";} ?>
    });
<?php
	}
}
?>
	jQuery('.flexslider-carousel').flexslider({
	  animation: "slide",
	  animationLoop: false,
	  itemWidth: 220,
	  minItems: 2,
	  maxItems: 4

	});

});
</script>


<!-- Hook Flexslider for Testimotials -->
<script type="text/javascript">
jQuery(window).load(function() {
<?php 
if(is_page(66)){
$disableSlider = of_get_option('dessky_disable_slider' ,'');
if($disableSlider!=true){
$sliderEffect = of_get_option('dessky_slider_effect' ,'fade'); 
$sliderInterval = of_get_option('dessky_slider_interval' ,600);
$sliderDisableNav = of_get_option('dessky_slider_disable_nav');

?>
    jQuery('.flexslider').flexslider({
          animation: "<?php echo $sliderEffect; ?>",
		  animationDuration: <?php echo $sliderInterval; ?>,
		  controlNav: <?php if($sliderDisableNav==true){echo "false";}else{echo "true";} ?>
    });
<?php
	}
}
?>
	jQuery('.flexslider-carousel').flexslider({
	  animation: "slide",
	  animationLoop: false,
	  itemWidth: 900,
	  minItems: 2,
	  maxItems: 13

	});

});
</script>

<!-- Hook Twitter -->
<?php
$twitterUsername = of_get_option('dessky_twitter_username' ,'dessky');
if($twitterUsername==""){$twitterUsername="dessky";}
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	//Twitter
	var twitusername = jQuery("#userandquery").attr('title');
	jQuery("#userandquery").tweet({
	  count: 3,
	  username: twitusername,
	  loading_text: "<?php _e('searching twitter...', 'dessky'); ?>"
	});
});
</script>

		
<?php 
	}// end dessky_print_javascript()
	add_action("wp_footer","dessky_print_javascript",20);
}

	
// get website title
if(!function_exists("dessky_get_footer_text")){
	function dessky_footer_text(){
	
		$foot= stripslashes(of_get_option('dessky_footer'));
		if($foot==""){
		
			_e('Copyright', 'dessky'); echo ' &copy;';
			global $wpdb;
			$post_datetimes = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970");
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes[0]->firstyear;
				$lastpost_year = $post_datetimes[0]->lastyear;
	
				$copyright = $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';
	
				echo $copyright;
				echo '<a href="'.home_url( '/').'">'.get_bloginfo('name') .'.</a>';
			}
			?><?php _e(' Developed by', 'dessky'); ?>	<a href="<?php echo esc_url( __( 'http://dessky.com', 'dessky' ) ); ?>" title="">
			<?php _e('Dessky.com','')?></a>
        <?php 
		}else{
        	echo $foot;
        }
		
	}// end dessky_get_title()
}
?>