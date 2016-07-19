<?php

/*
 * WPURP addon class: recipe grid
 */

if( class_exists( 'WPUltimateRecipe' ) ) {

    class WPURP_RecipeGrid extends WPUltimateRecipe {

        public function __construct() {

            $this->pluginName = 'wp-ultimate-recipe';
            $this->pluginDir = WP_PLUGIN_DIR . '/' . $this->pluginName;
            $this->pluginUrl = plugins_url() . '/' . $this->pluginName;

            $this->premiumName = 'wp-ultimate-recipe-premium';
            $this->premiumDir = WP_PLUGIN_DIR . '/' . $this->premiumName;
            $this->premiumUrl = plugins_url() . '/' . $this->premiumName;

            add_action( 'wp_enqueue_scripts', array( $this, 'recipe_grid_enqueue' ), -10 );

            add_shortcode( 'ultimate-recipe-grid', array( $this, 'recipe_grid_shortcode' ));
        }

        public function recipe_grid_enqueue() {
            // Styles
            wp_register_style( 'recipe-grid', $this->premiumUrl . '/addons/recipe-grid/css/recipe-grid.css', '', WPURP_PREMIUM_VERSION );
            wp_enqueue_style( 'recipe-grid' );

            wp_register_style( 'select2', $this->pluginUrl . '/lib/select2/select2.css', '', WPURP_PREMIUM_VERSION );
            wp_enqueue_style( 'select2' );

            // Scripts
            wp_register_script( 'select2', $this->pluginUrl . '/lib/select2/select2.min.js', array( 'jquery' ), WPURP_VERSION );
            wp_enqueue_script( 'select2' );

            wp_register_script( 'recipe-grid', $this->premiumUrl . '/addons/recipe-grid/js/recipe-grid.js', array( 'jquery' ), WPURP_PREMIUM_VERSION );
            wp_enqueue_script( 'recipe-grid' );

            wp_localize_script( 'recipe-grid', 'grid_options',
                array(
                    'match_all' => $this->option('recipe_grid_match_all', '1'),
                )
            );
        }

        public function recipe_grid_shortcode($options) {
            $options = shortcode_atts(array(
                'sort_by' => 'title',
                'sort_order' => 'ASC',
                'no_filter' => 'false',
                'images_only' => 'false',
                'display' => 'card'
            ), $options);

            $sort_by = strtolower($options['sort_by']);
            $sort_order = strtoupper($options['sort_order']);
            $no_filter = strtolower($options['no_filter']);
            $images_only = strtolower($options['images_only']);
            $display = strtolower($options['display']);

            $sort_by = in_array($sort_by, array('author','name','title','date','rand')) ? $sort_by : 'title';
            $sort_order = in_array($sort_order, array('ASC','DESC')) ? $sort_order : 'ASC';
            $filter = $no_filter == 'true' ? false : true;
            $images_only = $images_only != 'false' ? true : false;
            $display = in_array($display, array('card','text')) ? $display : 'card';

            global $wpurp;

            $recipes = $wpurp->get_recipes( $sort_by, $sort_order );
            $taxonomies = get_option('wpurp_taxonomies', array());

            $out = '';
            $js = '<script>var RecipeGrid = []; var RecipeGridFilter = {};';

            if($filter)
            {
                $out .= '<div class="wpurp-recipe-grid-filter-box">';

                if($this->option('recipe_tags_filter_categories', '0') == '1') {
                    $taxonomies['category'] = array(
                        'labels' => array(
                            'name' => __( 'Categories', $this->pluginName )
                        )
                    );
                }

                if($this->option('recipe_tags_filter_tags', '0') == '1') {
                    $taxonomies['post_tag'] = array (
                        'labels' => array(
                            'name' => __( 'Tags', $this->pluginName )
                        )
                    );
                }

                foreach($taxonomies as $taxonomy => $options) {
                    $args = array(
                        'show_option_none' => 'none',
                        'taxonomy' => $taxonomy,
                        'echo' => 0,
                        'hide_empty' => 1,
                        'class' => 'wpurp-recipe-grid-filter',
                        'name' => 'recipe-'.$taxonomy,
                        'show_count' => 0,
                        'orderby' => 'name',
                        'hide_if_empty' => true
                    );
                    $placeholder = $options['labels']['name'];

                    $select = wp_dropdown_categories( $args );
                    $select = str_ireplace("class='wpurp-recipe-grid-filter'", "class='wpurp-recipe-grid-filter' data-placeholder='".$placeholder."'", $select);

                    if($this->option('recipe_grid_multiselect', '1') == '1')
                    {
                        $select = str_ireplace("<option value='-1'>none</option>", "", $select);
                        $select = str_ireplace("class='wpurp-recipe-grid-filter'", "class='wpurp-recipe-grid-filter' multiple", $select);
                    } else {
                        $select = str_ireplace("<option value='-1'>none</option>", "<option></option>", $select);
                    }
                    $out .= $select;

                    $js .= 'RecipeGridFilter["' . $taxonomy . '"] = 0;';
                }

                $out .= '</div>';
            }


            $out .= '<div class="wpurp-recipe-grid-container count20">';
            if(count($recipes) == 0) {
                $out .= '<div>' . __( "No recipes found.", $this->pluginName ) . '</div>';
            }
            else
            {
                $out .= '<div class="no-recipes-found">' . __( "No recipes found.", $this->pluginName ) . '</div>';
                $recipe_count=0;
                foreach($recipes as $recipe)
                {

                 
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($recipe->ID), 'thumbnail' );

                    if ((!is_null($thumb['0']) || !$images_only) && $recipe_count < 4) // zig
                    {
                        $recipe_count = $recipe_count +1; // yes, old school zig
                        if(!is_null($thumb['0'])) {
                            $thumb_url = $thumb['0'];
                        } else {
                            $thumb_url = $this->premiumUrl . '/addons/recipe-grid/img/recipe_without_photo.png';
                        }

                        $js .= 'var Recipe = {};';
                        $js .= 'Recipe.id = ' . $recipe->ID . ';';

                        if($filter) {
                            foreach($taxonomies as $taxonomy => $options) {
                                $terms = wp_get_post_terms( $recipe->ID, $taxonomy);

                                $js .= 'Recipe["' . $taxonomy . '"] = [0';

                                $parents = array();

                                foreach($terms as $term) {
                                    $js .= ',' . $term->term_id;

                                    if($term->parent != 0) {
                                        $parents[] = $term->parent;
                                    }
                                }

                                if($this->option('recipe_grid_parents', '1') == '1')
                                {
                                    while(count($parents) > 0)
                                    {
                                        $children = $parents;
                                        $parents = array();

                                        foreach($children as $child) {
                                            $term = get_term($child, $taxonomy);

                                            $js .= ',' . $term->term_id;

                                            if($term->parent != 0) {
                                                $parents[] = $term->parent;
                                            }
                                        }
                                    }
                                }

                                $js .= '];';
                            }

                            $js .= 'RecipeGrid.push(Recipe);';
                        }

                        switch( $display ) {

                            case 'card':
                                $out .= '<div class="recipe recipe-card" id="recipe-'.$recipe->ID.'">';
                                $out .= '<a href="'.get_permalink($recipe->ID).'">';
                                $out .= '<img src="' . $thumb_url .'" />';
                                $out .= '<div class="recipe-title">'. $this->get_recipe_title( $recipe ) . '</div>';
                                $out .= '</a>';
                                $out .= '</div>';
                                break;

                            case 'text': //both
                                $out .= '<div class="recipe" id="recipe-'.$recipe->ID.'">';
                                $out .= '<a href="'.get_permalink($recipe->ID).'">';
                                $out .= $this->get_recipe_title( $recipe );
                                $out .= '</a>';
                                $out .= '</div>';
                                break;
                        }
                    }
                } /* end foreach */
            }

            $out .= '</div>';
            $js .= '</script>';

            return $out . $js;
        }
    }
}