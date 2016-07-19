<?php /* mods:
 * - use cwk-slider for image size.
 * - make title hot
 * - delete the next-prev hover over arrows (but isnt going away)
*/?>
<?php
$sliderarrange = of_get_option('dessky_slider_arrange');
$sliderDisableText = of_get_option('dessky_slider_disable_text');
?>


<!-- SLIDER z -->
<div id="outerslider">
    <div class="container">
        <div id="slidercontainer" class="twelve columns">

            <section id="slider">
                <div id="slideritems" class="flexslider">
                    <ul class="slides">
                    
						<?php
                        query_posts('post_type=slider-view&post_status=publish&showposts=-1&order=' . $sliderarrange);
                        while ( have_posts() ) : the_post();
                        
                        $custom = get_post_custom($post->ID);
                        $cf_slideurl = (isset($custom["slider-url"][0]))?$custom["slider-url"][0] : "";
                        $cf_thumb = (isset($custom["slider-image"][0]))? $custom["slider-image"][0] : "";
                        
                        $output="";
                        $output .='<li>';
                        
                            if($cf_slideurl!=""){
                                $output .= '<a href="'.$cf_slideurl.'">';
                            }
                           
                            //slider images
                            if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
                                if($cf_thumb!=""){
                                    $output .= '<img src="'.$cf_thumb.'" alt="'.get_the_title().'" />';
                                }else{
                                    $output .= get_the_post_thumbnail($post->ID,'cwk-slider');
                                }
                            }
                                
                            if($cf_slideurl!=""){
                                $output .= '</a>';
                            }
                            
                           //slider text
                           if($sliderDisableText!=true){
                               $output .='<div class="flex-caption">';
                                    if($cf_slideurl!=""){
                                        $output .= '<a href="'.$cf_slideurl.'">'; //zig
                                    }
								   $output .='<h1>'.get_the_title().'</h1>';
								   $output .='<p>'.get_the_excerpt().'</p>';
								   /*if($cf_slideurl!=""){
										$output .='<a href="'.$cf_slideurl.'" class="button">'.__('Read the Detail', 'dessky' ).'</a>';
								   } */
								    if($cf_slideurl!=""){
                                        $output .= '</a>'; //zig
                                    }
                               $output .='</div>';
                           }
                            
                        $output .='</li>';
                        
                        echo $output;
                        
                        endwhile;
                        wp_reset_query();
                        ?>
                        
                    </ul>
                </div>

          	</section>
            
        </div>
    </div>
</div>
<!-- END SLIDER -->

