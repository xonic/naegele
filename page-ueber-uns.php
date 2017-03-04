<?
/* Template Name: Über uns */

get_header() ?>

  <section class="carousel">
    <ul class="carousel__slides">
      <li class="carousel__slide"></li>
      <li class="carousel__slide"></li>
      <li class="carousel__slide"></li>
      <li class="carousel__slide"></li>
    </ul>
    <div class="carousel__overlay">
      <div class="wrapper">
        <h1 class="carousel__h1">
          <? echo get_field("hero_title"); ?>
        </h1>
        <h2 class="carousel__h2">
          <? echo get_field("hero_subtitle"); ?>
        </h2>
      </div>
    </div>
  </section>

  <section class="section news">
    <div class="wrapper">
      <?
        query_posts('posts_per_page=2');

        if (have_posts()) : ?>

        <h2 class="section__title is-hidden">
          <? echo get_field("section_2_title"); ?>
        </h2>

        <div class="news__grid">

      <?  // Start the loop
          while (have_posts()) : the_post(); ?>

            <article class="news__item">
              <h3 class="news__title"><? the_title(); ?></h3>
              <? the_content(); ?>
            </article>
      <?
          endwhile;

          wp_reset_query();
      ?>
      </div>
      <a class="btn" href="<?php echo get_post_type_archive_link( 'post' ); ?>"><? echo __('Weitere Neuigkeiten anzeigen'); ?></a>
      <?
        else :

          echo "No posts found";
          echo "</div>";

        endif;
      ?>
    </div>
  </section>
  <section class="shop section section--alt">
    <div class="wrapper">
      <div class="section__titles">
        <h2 class="section__title">
            <? echo get_field("section_3_title"); ?>
        </h2>
        <h3 class="section__subtitle">
            <? echo get_field("section_3_subtitle"); ?>
        </h3>
      </div>
      <div class="shop__grid section__grid">
        <div class="shop__img section__img">
          <img src="<? the_field('section_3_image'); ?>">
        </div>
        <div class="shop__content section__content">
            <? echo get_field("section_3_content"); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="production section">
    <div class="wrapper">
      <div class="section__titles">
        <h2 class="section__title">
            <? echo get_field("section_4_title"); ?>
        </h2>
        <h3 class="section__subtitle">
            <? echo get_field("section_4_subtitle"); ?>
        </h3>
      </div>
      <div class="section__grid production__grid">
        <div class="production__img section__img">
          <img src="<? the_field('section_4_image'); ?>">
        </div>
        <div class="production__content section__content">
            <? echo get_field("section_4_content"); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="section section--alt recycling">
    <div class="wrapper">
      <div class="section__titles">
        <h2 class="section__title">
            <? echo get_field("section_5_title"); ?>
        </h2>
        <h3 class="section__subtitle">
            <? echo get_field("section_5_subtitle"); ?>
        </h3>
      </div>
      <div class="section__grid recycling__grid">
        <div class="recycling__img section__img">
          <img src="<? the_field('section_5_image'); ?>">
        </div>
        <div class="recycling__content section__content">
            <? echo get_field("section_5_content"); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="section partner">
    <div class="wrapper">
      <h2 class="section__title">
          <? echo get_field("section_6_title"); ?>
      </h2>
      <h3 class="section__subtitle">
          <? echo get_field("section_6_subtitle"); ?>
      </h3>
      <div class="partner__content">
          <? echo get_field("section_6_content"); ?>
      </div>
    </div>
  </section>
  <section class="section section--alt team">
    <div class="wrapper">
      <h2 class="section__title">
          <? echo get_field("section_7_title"); ?>
      </h2>
      <h3 class="section__subtitle">
          <? echo get_field("section_7_subtitle"); ?>
      </h3>
      <div class="team__content">
          <? echo get_field("section_7_content"); ?>
      </ul>
      </div>
    </div>
  </section>
<? get_footer() ?>
