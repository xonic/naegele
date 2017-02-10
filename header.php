<!DOCTYPE html>
<html <? language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <script src="https://use.typekit.net/jsn0xvo.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
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
