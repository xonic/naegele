<? get_header() ?>
  
  <section class="news">
    <?
      query_posts('posts_per_page=2');

      if (have_posts()) :

        // Start the loop
        while (have_posts()) : the_post(); ?>

          <article class="">
            <? the_content(); ?>
          </article>
    <?
        endwhile;

        wp_reset_query();
    ?>
      <a href="">Weitere Neuigkeiten anzeigen</a>
    <?
      else :

        echo "No posts found";

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
