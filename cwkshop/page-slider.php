<?php
/**
 * Template Name: Page with Slider
 * The template for displaying pages with a slider at top.
 *
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */

get_header(); ?>

		<?php $sidebarposition = of_get_option('dessky_sidebar_position' ,'right'); ?>
         <?php get_template_part('slidercode-page'); ?>
         <!-- page-slider template -->
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                
                    <section id="content" class="nine columns <?php if($sidebarposition=="left"){echo "positionright omega";}else{echo "positionleft alpha";}?>">
                        <div class="padcontent">
                        
							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-content">
                                    <?php the_content( __( 'Read More', 'dessky' ) ); ?>
                                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dessky' ), 'after' => '</div>' ) ); ?>
                                    <?php edit_post_link( __( 'Edit', 'dessky' ), '<span class="edit-link">', '</span>' ); ?>
                                </div><!-- .entry-content -->
                            </div><!-- #post -->
                    
                            <?php comments_template( '', true ); ?>
                    
                            <?php endwhile; ?>
                            
                            <div class="clear"></div><!-- clear float --> 
                        </div><!-- main -->
                    </section><!-- content -->
                    
                    <aside id="sidebar" class="three columns <?php if($sidebarposition=="left"){echo "positionleft alpha";}else{echo "positionright omega";}?>">
                        <?php get_sidebar('page');?>  
                    </aside><!-- sidebar -->
                    
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
        
<?php get_footer(); ?>