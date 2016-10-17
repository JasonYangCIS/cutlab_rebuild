<?php
  /**
  * The Header for our theme.
  *
  * Displays all of the <head> section
  *
  * @package WordPress
  * @subpackage ReadyArtwork
  * @since ReadyArtwork HTML5 3.0
  */
  ?>
  <!DOCTYPE html>
  <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
  <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
  <!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php
      global $page, $paged;
      wp_title( '|', true, 'right' );
      bloginfo( 'name' );
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
      if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'ReadyArtwork' ), max( $paged, $page ) );
      ?></title>
      <meta http-equiv="cleartype" content="on">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">   
      <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" /> 
      <link rel="profile" href="http://gmpg.org/xfn/11" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php  bloginfo('template_directory');  ?>/css/main.css" />
      
      <script type="text/javascript" src="<?php  echo get_template_directory_uri()  ?>/js/cssrefresh.js"></script>  

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,600' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>
      <div id="container">
        <header id="header" class="header">
          <div class="header_container">
            <div class="mobile-logos">
              <div class="mobile_nav_btn">
                <a id="nav-toggle" href="javascript:void(0)"><span></span></a>
              </div>

              <?php get_sidebar('mobile-logos'); ?>
            </div>

            <div class="header-nav"><?php wp_nav_menu( array( 'container' => 'nav', 'fallback_cb' => 'readymobile_menu', 'theme_location' => 'primary', 'link_before' => '' ) ); ?></div>   
          </div>
          <!--[if lte IE 7]> <div style=' clear: both; height: 59px; padding:0 0 0 15px; position: relative;'> <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div> <![endif]-->

        </header>
        
        <div class="desktop-logos">
          <div class="wrapper">
            <?php get_sidebar('desktop-logos'); ?>
          </div>
        </div>

        <div id="main" role="main">

