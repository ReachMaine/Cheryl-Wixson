<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 * mods: 
 *  14Apr2014 zig: remove the author
 *  11Feb16 zig - add post meta 'show_featured_image'.
 */

get_header(); ?>


	<?php $sidebarposition = of_get_option('dessky_sidebar_position' ,'right'); ?>
    
    <!-- MAIN CONTENT single post-->
    <div id="outermain">
        <div class="container">
            <section id="maincontent" class="twelve columns">
            
                <section id="content" class="nine columns <?php if($sidebarposition=="left"){echo "positionright omega";}else{echo "positionleft alpha";}?>">
                	<div class="main">
                        <div id="singlepost">
                    
                             <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                             <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                             
                                <h2 class="posttitle">
                                <!--<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dessky' ), the_title_attribute( 'echo=0' ) ); ?>" data-rel="bookmark">-->
                                    <?php the_title(); ?>
                                <!--</a> -->
                                </h2>
                                
                                <div class="entry-utility">
                                    <?php /*_e('Posted by','dessky'); */?> <?php /* <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );">*/?><?php  /*the_author();?></a>*/ ?>Posted <?php _e('on','dessky');?>  <?php  the_time('F d, Y') ?>&nbsp;&nbsp;/&nbsp;&nbsp; <?php _e('Posted in','dessky');?> <?php the_category(', '); ?>
                                </div>
                                
								<?php
                                $custom = get_post_custom($post->ID);
                                $cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
                                $thumb = "";
                                if($cf_thumb!=""){
                                    $thumb = '<div class="postimg"><img src='. $cf_thumb .' alt="" class="scale-with-grid imgborder"/></div>';
                                }else {
                                    if(has_post_thumbnail($post->ID) ){ // zig 
                                        $thumb = "";
                                        $show_thumb = get_post_meta( $post->ID, "show_featured_image", true );
                                        if ($show_thumb != 'false') {                                      
                                            $thumb_class = "postimg"; //zig 
                                             if (get_post_meta( $post->ID, "blog_image_bigger", true )) {
                                                $thumb_class = "postimg cwk_bigger";
                                            }
                                            //$thumb = '<div class="postimg">'.get_the_post_thumbnail($post->ID, 'post-blog', array('alt' => '', 'class' => 'scale-with-grid imgborder')).'</div>';
                                            $thumb = '<div class="'.$thumb_class.'">'.get_the_post_thumbnail($post->ID, $cwk_postimg, array('alt' => '', 'class' => 'scale-with-grid imgborder')); // zig
                                            $thumb_caption =  get_post_meta( $post->ID, "blog_image_caption", true );
                                            if ($thumb_caption) {
                                                 $thumb .= '<div class="wp-caption-text">'.$thumb_caption.'</div>'; 
                                            }
                                            $thumb .= '</div>';
                                        }
                                    }
                                }
                                ?>
                                
								<?php 
                                 echo  $thumb;
                                ?>
                                
                                <div class="entry-content">
                                    <?php the_content(__('Read More','dessky'));?>
                                    <div class="clearfix"></div>
                                </div>
                                
                             </article>
                             <?php /* Display navigation to next/previous pages when applicable */ ?>
                <div id="nav-below" class="navigation">
                    <div class="nav-previous">
                        <?php previous_post_link('&laquo; %link', '%title', TRUE); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link &raquo;', '%title', TRUE); ?>
                    </div>
                </div><!-- #nav-below -->
                            <?php
                            
                            // If a user has filled out their description, show a bio on their entries.
                            if ( get_the_author_meta( 'description' ) ) : ?>
                            <div id="entry-author-info">
                                <div id="author-avatar">
                                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'dessky_author_bio_avatar_size', 60 ) ); ?>
                                </div><!-- author-avatar -->
                                <div id="author-description">
                                    <h2><span class="author"><?php printf( __( 'About %s', 'dessky' ), get_the_author() ); ?></span></h2>
                                    <?php the_author_meta( 'description' ); ?>
                                </div><!-- author-description	-->
                            </div><!-- entry-author-info -->
                            <?php endif; ?>
        
                            <?php comments_template( '', true ); ?>
                            
                            <?php endwhile; ?>
                        
                        </div><!-- singlepost --> 
                    </div><!-- main -->
                    <div class="clear"></div><!-- clear float --> 
                </section><!-- content -->
                
                <aside id="sidebar" class="three columns <?php if($sidebarposition=="left"){echo "positionleft alpha";}else{echo "positionright omega";}?>">
                    <?php get_sidebar();?>  
                </aside><!-- sidebar -->
                
            </section><!-- maincontent -->
        </div>
    </div>
    <!-- END MAIN CONTENT -->
     
<?php get_footer(); ?>