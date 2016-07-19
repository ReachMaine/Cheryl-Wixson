<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */
/* mods: 
 *  5May2014 zig display what we searched for
 */

get_header(); ?>


		<?php $sidebarposition = of_get_option('dessky_sidebar_position' ,'right'); ?>
        
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                
                    <section id="content" class="nine columns <?php if($sidebarposition=="left"){echo "positionright omega";}else{echo "positionleft alpha";}?>">
                        <div class="main padcontent">
 
                            <div id="searchresult">
                            <?php
                                /* Queue the first post, that way we know who
                                 * the author is when we try to get their name,
                                 * URL, description, avatar, etc.
                                 *
                                 * We reset this later so we can run the loop
                                 * properly with a call to rewind_posts().
                                 */
                                if ( have_posts() ) {
                                    ?> 
                                    <h1 class="entry-title">Search Results for '<?php echo get_search_query(); ?>'</h1>

                                    <?php

                                    the_post();
                                } else {
                                    ?>
                                    <h1 class="entry-title">No Results found for '<?php echo get_search_query(); ?>'</h1>
                                    <?php                                    
                                }
                            ?>
                    
                            <?php
                                /* Since we called the_post() above, we need to
                                 * rewind the loop back to the beginning that way
                                 * we can run the loop properly, in full.
                                 */
                                rewind_posts();
                            
                                /* Run the loop for the author archive page to output the authors posts
                                 * If you want to overload this in a child theme then include a file
                                 * called loop-author.php and that will be used instead.
                                 */
                                 get_template_part( 'loop', 'search' );
                                 
                            ?>
                            </div>
                    	<div class="clear"></div><!-- clear float --> 
                        </div><!-- main -->
                    </section><!-- content -->
                    
                    <aside id="sidebar" class="three columns <?php if($sidebarposition=="left"){echo "positionleft alpha";}else{echo "positionright omega";}?>">
                        <?php get_sidebar();?>  
                    </aside><!-- sidebar -->
                    
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->


<?php get_footer(); ?>