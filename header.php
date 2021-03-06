<!DOCTYPE html>
<html <? language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

    <script src="https://use.typekit.net/jsn0xvo.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script>
      // Add this event listener to prevent mobile safari
      // from disabling the ::active pseudo class
      document.addEventListener("touchstart", function(e) {});
    </script>
    <? wp_head(); ?>
  </head>
  <body <? body_class(); ?>>

    <header class="header">
      <nav class="nav-main">
        <? wp_nav_menu( array( 'theme_location' => 'main-nav' ) ); ?>
      </nav>
      <a href="<? echo site_url(); ?>" class="logo">
        <img class="logo__img" src="<? bloginfo('template_directory'); ?>/assets/img/logo.svg" alt="Nägele Logo">
      </a>
    </header>
    <main class="main">
