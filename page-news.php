<?
/* Template Name: News */

get_header(); ?>

<section class="hero">
  <div class="wrapper">
    <h1 class="hero__h1">
      <? echo __('Neuigkeiten'); ?>
    </h1>
    <h2 class="hero__h2"></h2>
  </div>
</section>

  <section class="news">
    <div class="wrapper">
      <?
        $args = array(
          'post_type' => 'post'
        );
        $loop = new WP_Query($args);

        if ($loop->have_posts()) : ?>
        <div class="news__wrapper">
      <?  // Start the loop
          while ($loop->have_posts()) : $loop->the_post(); ?>

            <article class="news__item">
              <h3 class="news__title"><? the_title(); ?></h3>
              <? the_content(); ?>
            </article>
      <?
          endwhile;

      ?>
      </div>
      <?
        else :

          echo "No posts found";
          echo "</div>";

        endif;
      ?>
    </div>
  </section>
<? get_footer(); ?>
