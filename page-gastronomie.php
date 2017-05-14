<?
/*
  Template Name: Gastronomie
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
<section class="schankanlagen section">
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
    <div class="section__grid schankanlagen__grid">
      <div class="schankanlagen__img section__img">
        <img src="<? the_field('section_1_image'); ?>">
      </div>
      <div class="schankanlagen__content section__content">
        <? echo get_field('section_1_text'); ?>
        <? if(ICL_LANGUAGE_CODE == 'de') : ?>
          <a href="<? echo get_site_url().'/produkt-kategorie/postmix-sirupe/'; ?>" class="btn">Schankprodukte anzeigen</a>
        <? endif; ?>
        <? if(ICL_LANGUAGE_CODE == 'it') : ?>
          <a href="<? echo get_site_url().'/it/produkt-kategorie/sciroppi-postmix/'; ?>" class="btn">Mostra prodotti</a>
        <? endif; ?>
      </div>
    </div>
  </div>
</section>
<section class="festservice section section--alt">
  <div class="wrapper">
    <div class="section__titles">
      <h2 class="section__title">
        <? echo get_field('section_2_title'); ?>
      </h2>
      <h3 class="section__subtitle">
        <? echo get_field('section_2_subtitle'); ?>
      </h3>
    </div>
    <div class="section__grid festservice__grid">
      <div class="festservice__img section__img">
        <img src="<? the_field('section_2_image'); ?>">
      </div>
      <div class="festservice__content section__content">
        <? echo get_field('section_2_text'); ?>
        <? if(ICL_LANGUAGE_CODE == 'de') : ?>
          <a href="mailto:info@naegele.it" class="btn">Mietanfrage senden</a>
        <? endif; ?>
        <? if(ICL_LANGUAGE_CODE == 'it') : ?>
          <a href="mailto:info@naegele.it" class="btn">Manda richiesta</a>
        <? endif; ?>
      </div>
    </div>
  </div>
</section>
<? get_footer() ?>
