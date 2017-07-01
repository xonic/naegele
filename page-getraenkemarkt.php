<?
/*
  Template Name: Getränkemarkt
*/

get_header() ?>
<? if( get_field('page_title') && get_field('page_subtitle')) : ?>
  <section class="hero">
    <div class="wrapper">
      <h1 class="hero__h1">
        <? echo get_field('page_title'); ?>
      </h1>
      <h2 class="hero__h2">
        <? echo get_field('page_subtitle'); ?>
      </h2>
    </div>
  </section>
<? endif ?>
<section class="getraenkemarkt section">
  <div class="wrapper">
    <? if( get_field('section_1_title') && get_field('section_1_subtitle')) : ?>
      <div class="section__titles">
        <h2 class="section__title">
          <? echo get_field('section_1_title'); ?>
        </h2>
        <h3 class="section__subtitle">
          <? echo get_field('section_1_subtitle'); ?>
        </h3>
      </div>
    <? endif ?>
    <div class="section__grid getraenkemarkt__grid">
      <div class="getraenkemarkt__img section__img">
        <img src="<? the_field('section_1_image'); ?>">
      </div>
      <div class="getraenkemarkt__content section__content">
        <? echo get_field('section_1_text'); ?>
      </div>
    </div>
  </div>
</section>
<section class="section section--alt">
  <div class="section__titles">
    <h2 class="section__title">
      <? echo get_field('section_2_title'); ?>
    </h2>
    <h3 class="section__subtitle">
      <? echo get_field('section_2_subtitle'); ?>
    </h3>
  </div>
  <div class="wrapper">
    <iframe style="height:50vw;overflow:hidden;"  src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sit!2sit!4v1479375319940!6m8!1m7!1sZje1oMfy_LYAAAQfCZKnDA!2m2!1d46.67915005792347!2d11.13994343443085!3f97.76589742243586!4f-3.4618852720608118!5f0.7820865974627469" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
</section>
<? get_footer() ?>
