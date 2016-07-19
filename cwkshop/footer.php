<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */
 
?>		

        <!-- FOOTER SIDEBAR -->
        <div id="outerfootersidebar">
        	<div class="container">
                <div id="footersidebarcontainer" class="twelve columns"> 
                
                    <footer id="footersidebar">
                        <div id="footcol1"  class="three columns alpha">
                        	<?php get_sidebar('footer1');?>
                        </div>
                        <div id="footcol2"  class="three columns">
                        	 <?php get_sidebar('footer2');?>    
                        </div>
                        <div id="footcol3"  class="three columns">
                        	 <?php get_sidebar('footer3');?>    
                        </div>
                        <div id="footcol4"  class="three columns omega">
                        	 <?php get_sidebar('footer4');?>    
                        </div>
                        <div class="clear"></div>
                    </footer>
                    
                </div>
            </div>
        </div>
        <!-- END FOOTER SIDEBAR -->
        
        
        <!-- FOOTER -->
        <div id="outerfooter">
        	<div class="container">
                <div id="footercontainer" class="twelve columns">
                
                    <footer id="footer"><?php dessky_footer_text(); ?><div class="eai-copy">&copy; <?php echo date('Y');?> Cheryl Wixson's Kitchen, LLC.  All Rights Reserved</div></footer>
                     <?php 
                        $optsocialtext = stripslashes(of_get_option('dessky_social_text'));
                        $optenableSocialIcon = of_get_option('dessky_enable_socialicon');
                        echo $optsocialtext;	
                        if($optenableSocialIcon==true){				
							// get the social network icon
							$socialiconoutput = dessky_socialicon(); 
							echo $socialiconoutput;
                        }
                    ?>
                    
                </div>
            </div>
        </div>
        <!-- END FOOTER -->
        
	</div><!-- end bodychild -->
</div><!-- end outercontainer -->


<?php $google = stripslashes(of_get_option('dessky_google'));?>
<?php if($google=="false"){?>
<?php }else{?>
<script>
<?php echo $google; ?>
</script>
<?php } ?>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>