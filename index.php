<? get_header() ?>

  <section class="news">
    <div class="news__inner">
      <?
        query_posts('posts_per_page=2');

        if (have_posts()) :

          // Start the loop
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
      <a class="btn" href="">Weitere Neuigkeiten anzeigen</a>
      <?
        else :

          echo "No posts found";
          echo "</div>";

        endif;
      ?>
  </section>
  <section class="page-content">
    <?
      if (have_posts()) :
        // Start the loop
        while (have_posts()) : the_post(); ?>

          <article class="">
            <? the_content(); ?>
          </article>
    <?
        endwhile;

      else :
        echo "Page content is missing";
      endif;
    ?>
  </section>
<? get_footer() ?>
