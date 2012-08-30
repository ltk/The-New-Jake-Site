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
  <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
  
  <?php

  roots_head();
  wp_head();

  if (WP_DEBUG == true){
    get_template_part('templates/dev', 'less');
  }

  ?>

  <?php if(is_front_page()): ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.orbit-1.2.3.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/bootstrap-tab.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/bootstrap-tooltip.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/bootstrap-popover.js"></script>
    <script type="text/javascript">
    $(function(){
      $('.map-dot').popover({placement: 'left'});
    });
    </script>
  <?php endif; ?>


  <script type="text/javascript" src="http://fast.fonts.com/jsapi/44a6fbb6-a6a4-4b88-9606-0a2173f867f6.js"></script>
</head>

<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert">Your browser is too old to view this site properly. <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->

  <?php roots_header_before(); ?>
  <header class="<?php echo WRAP_CLASSES; ?> clearfix" role="document">
    <div class="pull-right">
    <?php

      get_template_part('templates/nav', 'action');
      get_template_part('templates/search', 'site');

    ?>
    </div>

    <a id="brand" href="<?php echo get_home_url(); ?>" title="<?php bloginfo('name'); ?> | Home">CCAP</a>

    <?php

    roots_header_before(); 
    get_template_part('templates/nav', 'primary');
    roots_header_after();

    ?>

  </header>