<?

get_header() ?>
  <section class="hero">
    <h1 class="h1">
      Produkte
    </h1>
    <h2 class="h2">
      Frisch. Fruchtig. Lecker.
    </h2>
  </section>
  <section class="products">
    <?
      query_posts('post_type=product');

      if (have_posts()) :

        // Start the loop
        while (have_posts()) : the_post();

          $img = get_field('product_image');
        ?>

          <article class="product <? echo $post->ID; ?>">
            <? if (!empty($img)) : ?>
            <img src="<? echo $img['url']; ?>" alt="<? echo $img['alt']; ?>" />
            <? endif; ?>
            <h3 class="product__name"><? echo $post->post_title; ?></h3>
            <p class="product__"
          </article>
    <?
        endwhile;

        wp_reset_query();

      else :

        echo "No products found";

      endif;
    ?>
  </section>
<? get_footer() ?>
