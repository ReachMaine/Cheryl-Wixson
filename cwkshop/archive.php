<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */

get_header(); ?>


		<?php $sidebarposition = of_get_option('dessky_sidebar_position' ,'right'); ?>

        <!-- MAIN CONTENT Archive--> <!-- <?php  if (is_category('cheryl-dishes')) {echo 'cat cheryl-dishes';} else {echo 'not cheryl';} ?> -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                    <section id="content" class="nine columns summary <?php if($sidebarposition=="left"){echo "positionright omega";}else{echo "positionleft alpha";}?>">
                        <div class="main padcontent">
							<?php
                                /* Since we called the_post() above, we need to
                                 * rewind the loop back to the beginning that way
                                 * we can run the loop properly, in full.
                                 */
                                rewind_posts();

                                /* Run the loop for the archives page to output the posts.
                                 * If you want to overload this in a child theme then include a file
                                 * called loop-archives.php and that will be used instead.
                                 */
                                get_template_part( 'loop', 'archive' );
                            ?>
                    	<div class="clear"></div><!-- clear float -->
                        </div><!-- main -->
                    </section><!-- content -->
                    <aside id="sidebar" class="three columns zarchive <?php if($sidebarposition=="left"){echo "positionleft alpha";}else{echo "positionright omega";}?>">
											<!-- post sidebar -->
                        <?php get_sidebar('post-sidebar');?>
                    </aside><!-- sidebar -->

                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->

<?php get_footer(); ?>
