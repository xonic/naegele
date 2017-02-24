<?

get_header() ?>
  <section class="hero">
    <div class="wrapper">
      <h1 class="hero__h1">
        Die besten Produkte
      </h1>
      <h2 class="hero__h2">
        Aus traditioneller Herstellung.
      </h2>
    </div>
  </section>
  <div class="wrapper">
    <nav class="nav-prod">
      <div class="nav-prod__col">
        <h2 class="nav-prod__title"><? echo __('Unsere Marken'); ?></h2>
        <ul class="nav-prod__items">
          <?php
            $args=array(
              'taxonomy' => 'product_category',
              'title_li' => ''
            );
            $output = 'objects'; // or names
            $categories=wp_list_categories($args,$output);
            if  ($categories) {
              foreach ($categories  as $category ) {
                echo '<p>' . $category->name . '</p>';
              }
            }

            wp_reset_query();
          ?>
        </ul>
      </div>
      <div class="nav-prod__col">
        <h2 class="nav-prod__title"><? echo __('Gesamtes Sortiment'); ?></h2>
        <ul class="nav-prod__items">
          <?php
            $args=array(
              'taxonomy' => 'product_tag',
              'title_li' => ''
            );
            $output = 'objects'; // or names
            $categories=wp_list_categories($args,$output);
            if  ($categories) {
              foreach ($categories  as $category ) {
                echo '<p>' . $category->name . '</p>';
              }
            }
          ?>
        </ul>
      </div>
    </nav>
    <section class="products">
      <?
        query_posts('post_type=product');

        if (have_posts()) :

          // Start the loop
          while (have_posts()) : the_post();

            $img = get_field('product_image');
          ?>

            <article class="product <? echo $post->ID; ?>">
              <a href="<? echo get_permalink(); ?>" class="product__link" title="<? echo __('Produkt anzeigen'); ?>">
                <? if (!empty($img)) : ?>
                <img src="<? echo $img['url']; ?>" alt="<? echo $img['alt']; ?>" />
                <? endif; ?>
                <h3 class="product__name"><? echo $post->post_title; ?></h3>
              </a>
            </article>
      <?
          endwhile;

          wp_reset_query();

        else :

          echo "No products found";

        endif;
      ?>
    </section>
  </div>
<? get_footer() ?>
