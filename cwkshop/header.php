<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */
/* mods 
* 25April14 zig: 
*     - dont display logo on front page
*     - move slider here
*     - dont show shopping cart on home page.
*     - move nav bar outside of outercontianer so we can make it span 100%.
* 8July2014 zig
*   - add Google Tag manager code 
*/
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php dessky_document_title(); ?></title>
<?php $bodyclass = ""; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" id="templateurl" href="<?php echo get_template_directory_uri(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php 
$favicon = of_get_option('dessky_favicon');
if($favicon =="" ){
?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />
<?php }else{?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php }?>

<?php

/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
  wp_enqueue_script( 'comment-reply' );

/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */
wp_head();
?>

</head>

<body <?php body_class($bodyclass); ?>>
<!-- Google Tag Manager -->
  <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P2T8BS"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-P2T8BS');</script>
<!-- End Google Tag Manager -->


<div id="bodychild">
  <div id="outercontainer">
    
        <!-- HEADER -->
        <div id="outerheader">
          <div class="container">
            <header id="top" class="twelve columns">
              <div id="logo" class="three columns alpha"><?php if (!is_front_page()) { dessky_logo();} // print the logo html?></div>
                <div id="headerright" class="six columns omega">
                <?php global $woocommerce; ?>      
                    <div id="chart">
                     <?php if (!is_front_page()) { /* zig */ ?>
                      <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" id="shopping-cart"></a>
                      <h6><?php _e('Shopping Cart', 'dessky'); ?></h6>
                        <p>You have <?php /* display items number */ echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></p>
                     <?php } ?>
                    </div>

                    <div class="clear"></div>
                    <?php wp_nav_menu( array(
                      'container'       => 'ul', 
                      'menu_id'         => 'user-nav', 
                      'depth'           => 0,
                      'sort_column'    => 'menu_order',
                      'fallback_cb'     => 'false',
                      'theme_location' => 'topmenu' 
                      )); 
                    ?>
                  </div> 
                  <div class="clear"></div>
                <?php get_template_part('slidercode'); ?>
 
                <div class="clear"></div>
            </header>
            </div> <!-- container -->
            <div id="nav-container" >
               <section id="navigation" class="twelve columns">
                    <nav id="nav-wrap">
                      <?php wp_nav_menu( array(
                          'container'       => 'ul', 
                          'menu_class'      => 'sf-menu',
                          'menu_id'         => 'topnav', 
                          'depth'           => 0,
                          'sort_column'    => 'menu_order',
                          'fallback_cb'     => 'false',
                          'theme_location' => 'mainmenu' 
                          )); 
                        ?>
                    </nav><!-- nav -->  
                    
                    <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="bgsearch">
                      <input type="text" name="s" id="s" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" value="Search" />
                        <input class="searchbutton" type="submit" value="">
                    </div>
                    </form>
                    
                    <div class="clear"></div>
                </section>
            </div>
        </div> <!-- outerhead -->
        <!-- END HEADER -->