<?php
	//if(file_exists(get_stylesheet_directory().'/custom/ultimate-recipe.php'))
		require_once(get_stylesheet_directory().'/custom/ultimate-recipe.php');

	$cwk_thumbimg = array(200, 999); // size of featured image in archive/category blog
	$cwk_postimg = array(200, 999); // size of featured image on single post.
	add_image_size('recipe-medium', 400, 400, false );
	add_image_size( 'cwk-slider', 1420, 447, true ); // Slider
	/*** remove review tab ***/
	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
	function woo_remove_product_tabs( $tabs ) {
	    unset( $tabs['reviews'] ); 			// Remove the reviews tab
	    return $tabs;

	}

	/** add in the new tabs, nutrition & recipes **/
	add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
	function woo_new_product_tab( $tabs ) {

		// Adds the recipe tab
	 	$tabs['recipe_tab'] = array(
			'title' 	=> __( 'Recipes', 'woocommerce' ),
			'priority' 	=> 51,
			'callback' 	=> 'woo_recipes_tab_content'
		);
		// adds the nutrition tab - turned off for now.
		/* $tabs['nutrition_tab'] = array(
			'title' 	=> __( 'Nutrition', 'woocommerce' ),
			'priority' 	=> 50,
			'callback' 	=> 'woo_nutrition_tab_content'
		); */
		return $tabs;

	}
	function woo_nutrition_tab_content() {

		// The new nutrition content
		get_template_part('cwk-partials/nutrition');

	}

	function woo_recipes_tab_content() {

		// The related recipes
		get_template_part('cwk-partials/recipe');

	}

	/* rename the product tab */
	add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
	function woo_rename_tab($tabs) {

	 $tabs['description']['title'] = 'The Story';

	 return $tabs;
	}
	/* rename the product description heading */
	add_filter('woocommerce_product_description_heading', 'cwk_rename_descrtab', 98, 1);
	function cwk_rename_descrtab($desc_string) {

	 $desc_string = 'The Product Story';

	 return $desc_string;
	}

	/* move price in single product display to under excerpt, change the priority */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

	/* remove the 'log in/log out' from the main menu */
    add_action( 'after_setup_theme', 'cwk_setup' ); /* child function.php runs before main theme and wooshop not pluginable */
	function cwk_setup () {
		remove_filter('wp_nav_menu_items', 'add_loginout_link', 10, 2 ) ;

	}

	/* add shortcode for only 3 recipes */
	function cwk_3recipes_func( $atts ) {
		return "zig was here.";
	}
	add_shortcode ('cwk_three_recipes', 'cwk_3recipes_func');

	if ( function_exists('register_sidebar') ){
			// Banner Ad
			 register_sidebar(array(
				'name' => 'Home Page Bottom',
				'id' => 'homebottom',
				'description' => 'Widget at bottom of homepage',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="home widget-title">',
				'after_title'   => '</h3>',
			));
		} //function_exists('register_sidebar')

			/*****  change the login screen logo ****/
	function my_login_logo() { ?>
		<style type="text/css">
			body.login div#login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/cw.png);
				padding-bottom: 30px;
				background-size: cover;
				margin-left: 0px;
				margin-bottom: 0px;
				margin-right: 0px;
				height: 105px;
				width: 100%;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
	/*****  end custom login screen logo ****/

	/***** change admin favicon *****/
	/* add favicons for admin */
	add_action('login_head', 'add_favicon');
	add_action('admin_head', 'add_favicon');

	function add_favicon() {
		$favicon_url = get_stylesheet_directory_uri() . '/images/admin-favicon.ico';
		echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
	}
	/***** end admin favicon *****/



?>
