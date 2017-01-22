<? get_header() ?>

<header class="header">
  <a href="/" class="logo">
    <img class="logo__img" src="<? bloginfo('template_directory'); ?>/assets/img/logo.svg" alt="Nägele Logo">
  </a>
  <h1 class="h1">
    Mein Getränkemarkt
  </h1>
  <h2 class="h2">
    Frisch. Fruchtig. Lecker.
  </h2>
</header>
<main class="main">
  <section class="news">
    <?
      $temp_post = $post;

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
  <?
    if (have_posts()) :

    else :
      echo "Page content is missing.";
    endif;
  ?>
</main>
<? get_footer() ?>
