<?php /* custom code for woocommerce  */
/* moved some from functions.php */

	/** adj tabs on single product **/
	add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
	function woo_new_product_tab( $tabs ) {

    /* rename the product tab */
     $tabs['description']['title'] = 'The Story';

    // remove the additional information tab (automatically filled for attributes of variants)
    unset( $tabs['additional_information'] );

	   // Remove the reviews tab
  	 unset( $tabs['reviews'] );

		// Adds the recipe tab
    /* zig xout with new plugin....if (get_post_meta( get_the_ID(), "related-recipes", true)) {
  	 	$tabs['recipe_tab'] = array(
  			'title' 	=> __( 'Recipes', 'woocommerce' ),
  			'priority' 	=> 51,
  			'callback' 	=> 'woo_recipes_tab_content'
  		);
    } */
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


	/* rename the product description heading */
	add_filter('woocommerce_product_description_heading', 'cwk_rename_descrtab', 98, 1);
	function cwk_rename_descrtab($desc_string) {

	 $desc_string = 'The Product Story';

	 return $desc_string;
	}
/* end of tabs */

	/* move price in single product display to under excerpt, change the priority */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );


// remove the sku from product page
add_filter( 'wc_product_sku_enabled', 'bbloomer_remove_product_page_sku' );

function bbloomer_remove_product_page_sku( $enabled ) {
    if ( !is_admin() && is_product() ) {
        return false;
    }
   return $enabled;
}
