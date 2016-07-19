<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 *  */
/*
 * modications:
 *	18 Mar 2014 zig:  remove the comment count & link
 * display the category for an archive
 *  14 Apr 2014 zig:  remove the Author from title
 *  5 May 2014 zig: add no-blog-image for cheryl's blog
*/
?>
	
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<h1 class="posttitle"><?php _e( 'Not Found', 'dessky' ); ?></h1>
		<div class="entry">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'dessky' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>
<?php endif; ?>

<?php /* zig:  display the category for an archive*/
	if ( have_posts() ) :
		$cwk_cat = single_cat_title( '', false );
		if ($cwk_cat) {
			if (($cwk_cat == 'Cheryl Dishes') || ($cwk_cat == 'Farmers') || ($cwk_cat == 'News')) {
				echo '<div class="cwk-cattitle-block">';
				echo '<h1 class="cwk-cat-title">'.$cwk_cat.'</h1>';
				switch ($cwk_cat) {
					case 'Cheryl Dishes':
						$cwk_cat_icon="cdishes.png";
						break;
					case 'Farmers':
						$cwk_cat_icon = "farmers.png";
						break;
					case 'News':
						$cwk_cat_icon = "news.png";
				} 
				echo '<img class="cwk-cat-icon" src="'.get_stylesheet_directory_uri().'/images/'.$cwk_cat_icon.'"/>';
				
				echo '</div>';
			} else {
				echo '<h1 class="cattitle">'.$cwk_cat.'</h1>';	
			}
			
		} else {
			echo "<!-- no category title -->";
		}
	endif;	
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php /* How to display all posts. */ ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    		    
    		
            
    		<?php $custom = get_post_custom($post->ID);
				$cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
				
				if($cf_thumb!=""){
					$thumb = '<img src="'. $cf_thumb .'" alt=""  class="scale-with-grid"/>';
				} elseif (has_post_thumbnail($post->ID) ){
					//$thumb = get_the_post_thumbnail( get_the_ID() , 'post-blog', array('class' => 'scale-with-grid'));
					$thumb = get_the_post_thumbnail( get_the_ID() , array(200,999), array('class' => 'scale-with-grid')); // zig
				} else {
					$thumb ="";
					if ($cwk_cat == 'Cheryl Dishes') {
						$thumb ='<img src="'.dirname( get_bloginfo('stylesheet_url') ).'/images/no-blog-image.jpg" class="scale-with-grid wp-post-image" >';
					}
				}
				if ($thumb) {	?>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dessky' ), the_title_attribute( 'echo=0' ) ); ?>" >
			            <div class="postimg">
							<?php echo  $thumb; ?>
			            </div>
		            </a>
			<?php 	} 	?>

           <h2 class="posttitle">
            	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dessky' ), the_title_attribute( 'echo=0' ) ); ?>" data-rel="bookmark"><?php the_title(); ?></a>
            </h2>
            
            <?php if(!is_search()){ ?>
            <div class="entry-utility">
                <?php /*_e('Posted by','dessky'); */?> Posted <?php /* <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a> */ ?> <?php _e('on','dessky');?>  <?php  the_time('F d, Y') ?>
                <?php /* <a href="<?php comments_link(); ?>"><?php comments_number( __('no comment', 'dessky'), __('1 comment','dessky'), '% '.__('comments', 'dessky') ); ?></a> //zig */ ?>
            </div>
             <?php } ?>
             
            <div class="entry-content">
				<?php if(is_search()){ ?>
                    <p><?php $excerpt = get_the_excerpt(); echo dessky_string_limit_words($excerpt,50);?></p>
                <?php }else{?>
                	<p><?php $excerpt = get_the_excerpt(); echo dessky_string_limit_words($excerpt,35);?></p>
					<?php /* the_excerpt(); */ ?>
                <?php } ?>
                <?php /* zig  <a href="<?php the_permalink(); ?>" class="button"><?php _e('Read More', 'dessky' ); ?></a> */ ?>
                <?php /* <div class="clearfix"></div> */ ?>
            </div>
    
		<div class="clear"></div>
        
	</article><!-- end post -->
	
	<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>


<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
 <?php if(function_exists('wp_pagenavi')) { ?>
	 <?php wp_pagenavi(); ?>
 <?php }else{ ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'dessky' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'dessky' ) ); ?></div>
	</div><!-- #nav-below -->
<?php }?>
<?php endif; ?>