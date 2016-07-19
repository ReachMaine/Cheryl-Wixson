<?php
/**
 * Template Name: CWK-No sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */

get_header(); ?>

        <!-- MAIN CONTENT CWK-NoSidebar -->
        <div id="outermain" class="inner">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                
                  <?php /* zig             
                <!-- BEFORE CONTENT -->

                <div id="outerbeforecontent" class="nopagebar">

                    <div class="container">

                        <section id="beforecontent" class="twelve columns">

                            <?php  get_template_part( 'title');   ?>
                            <?php dynamic_sidebar('add-this-button'); ?>

                            <div class="clear"></div>

                        </section>

                    </div>

                </div>
                */ ?>
                <!-- END BEFORE CONTENT -->

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content( __( 'Read More', 'dessky' ) ); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dessky' ), 'after' => '</div>' ) ); ?>
                            <?php //edit_post_link( __( 'Edit', 'dessky' ), '<span class="edit-link">', '</span>' ); ?>
                            <div class="clear"></div><!-- clear float --> 
                        </div><!-- .entry-content -->                         
                    </div><!-- #post -->                    
            
                    <?php //comments_template( '', true ); ?>
            
                    <?php endwhile; ?>
                                        
                    <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
   
<?php get_footer(); ?>