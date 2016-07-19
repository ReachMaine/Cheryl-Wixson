<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @package WooCommerce
 * @version 2.1.2
 * @todo replace loop-shop with a content template and include query/loop here instead.
 */

get_header('shop'); ?>
	
    <?php $sidebarposition = of_get_option('dessky_sidebar_position' ,'right'); ?>
        
    <!-- MAIN CONTENT product archive also -->
    <div id="outermain">
        <div class="container">
            <section id="maincontent" class="twelve columns">
            
            	<!-- BEFORE CONTENT -->
                <div id="outerbeforecontent" class="<?php echo $class;?>">
                    <div class="container">
                        <section id="beforecontent" class="twelve columns">
                            <?php  get_template_part( 'title');  ?>                         
                            <?php dynamic_sidebar('add-this-button'); ?>
                            <div class="clear"></div>
                        </section>
                    </div>
                </div>
                <!-- END BEFORE CONTENT -->
            
                <section id="content" class="nine columns <?php if($sidebarposition=="left"){echo "positionright omega";}else{echo "positionleft alpha";}?>">
                    <div class="padcontent">

							<?php 
                                /** 
                                 * woocommerce_before_main_content hook
                                 *
                                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                                 * @hooked woocommerce_breadcrumb - 20
                                 */
								remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');	
								remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);	
                                do_action('woocommerce_before_main_content');
                            ?>
							<?php if ( is_tax() && get_query_var( 'paged' ) == 0 ) : ?>
                                <?php echo '<div class="term-description">' . wpautop( wptexturize( term_description() ) ) . '</div>'; ?>
                            <?php elseif ( ! is_search() && get_query_var( 'paged' ) == 0 && ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
                                <?php echo '<div class="page-description">' . apply_filters( 'the_content', $shop_page->post_content ) . '</div>'; ?>
                            <?php endif; ?>
                                    
                            <?php if ( have_posts() ) : ?>
                            
                                <?php do_action('woocommerce_before_shop_loop'); ?>
                            	<div id="dessky-display-products">
                                    <ul class="dessky-display-pd-col-4 products">
                                    
                                        <?php woocommerce_product_subcategories(); ?>
                                
                                        <?php while ( have_posts() ) : the_post(); ?>
                                
                                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                                
                                        <?php endwhile; // end of the loop. ?>
                                        
                                    </ul>
                    			</div>
                                <?php do_action('woocommerce_after_shop_loop'); ?>
                            
                            <?php else : ?>
                            
                                <?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
                                        
                                    <p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
                                        
                                <?php endif; ?>
                            
                            <?php endif; ?>
                            
                            <div class="clear"></div>
							<?php 
                                /** 
                                 * woocommerce_pagination hook
                                 *
                                 * @hooked woocommerce_pagination - 10
                                 * @hooked woocommerce_catalog_ordering - 20
                                 */		
                                do_action( 'woocommerce_pagination' ); 
                            ?>
							<?php
                                /** 
                                 * woocommerce_after_main_content hook
                                 *
                                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                                 */	 
								remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end');	
                                do_action('woocommerce_after_main_content'); 
                            ?>
    						<div class="clear"></div><!-- clear float --> 
                        </div><!-- main -->
                    </section><!-- content -->
                    
                    <aside id="sidebar" class="three columns <?php if($sidebarposition=="left"){echo "positionleft alpha";}else{echo "positionright omega";}?>">
                        <?php 
							/** 
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */		
							do_action('woocommerce_sidebar'); 
						?>
                    </aside><!-- sidebar -->
                    
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->

<?php get_footer('shop'); ?>