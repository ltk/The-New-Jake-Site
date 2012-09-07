<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" type="image/png"> 
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" type="image/png"> 
  <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.5.3.min.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.7.2.min.js"><\/script>')</script>
  
  <?php

  roots_head();
  wp_head();

  if (WP_DEBUG == true){
    get_template_part('templates/dev', 'less');
  }

  ?>



  
</head>

<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert">Your browser is too old to view this site properly. <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->

  <?php roots_header_before(); ?>
  <header id="header" role="document">
    <div class="inner clearfix">
      <nav class="pull-right">
        <ul>
          <li><a href="#" title="#">ABOUT</a></li>
          <li><a href="#" title="#">WORK</a></li>
          <li><a href="#" title="#">BLOG</a></li>
          <li><a href="#" title="#">CONTACT</a></li>
        </ul>
        <?php
          //get_template_part('templates/nav', 'action');
          //get_template_part('templates/search', 'site');
        ?>
      </nav>
    </div>


    <a id="brand" href="<?php echo get_home_url(); ?>" title="<?php bloginfo('name'); ?> | Home">The Jake Group</a>

    <?php

    //roots_header_before(); 
      //get_template_part('templates/nav', 'primary');
    //roots_header_after();

    ?>

  </header>