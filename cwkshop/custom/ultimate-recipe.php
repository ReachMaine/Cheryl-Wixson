<?php /* functions etc for ultimate recipe plugin
    20Dec16 zig - make shortcode for list of recipes
*/

// add shortcode that gets a list of recipes in a category (no image)
// currently pulling from 'product categories', should it????
add_shortcode( 'cwk-recipe-list', 'cwk_recipe_list_shortcode' );
if (!function_exists('cwk_recipe_list_shortcode'  )) {
    function cwk_recipe_list_shortcode($options) {
        $options = shortcode_atts(array(
            'sort_by' => 'title',
            'sort_order' => 'ASC',
            'display' => 'card',
            'category' => '',
            'number' => '',
        ), $options);

        $sort_by = strtolower($options['sort_by']);
        $sort_order = strtoupper($options['sort_order']);
        $display = strtolower($options['display']);
        $display = in_array($display, array('card','text')) ? $display : 'card';
        $category = $options['category'];
        if ($options['number'] == '') {
            $limit = get_option( 'posts_per_page' );
        } else {
            $limit = $options['number'];
        }
        $html_out = "";
        $tax_query = array('taxonomy' => 'product-category', 'field' => 'slug', 'terms'=> $category);
        $args = array(
                'post_type' => 'recipe',
                'tax_query' => array($tax_query),
                'orderby' => $sort_by,
                'order' => $sort_order,
                'posts_per_page' => $limit,
            );
        $recipe_posts = new WP_Query($args);
        if ( $recipe_posts->have_posts() ) {
            $html_out .= '<ul class="cwk-recipe-list">';
            while ($recipe_posts->have_posts()){
                $recipe_posts->the_post();
                $html_out .= '<li class="cwk-recipe"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
            } /* end while have reciped */
        } else {
            $html_out .= " none<br>";
        }
        wp_reset_postdata();
        return $html_out;
    }
}
