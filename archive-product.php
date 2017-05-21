<?

get_header() ?>
  <section class="hero">
    <div class="wrapper">
      <h1 class="hero__h1">
        <? echo __('Die besten Produkte', 'naegele'); ?>
      </h1>
      <h2 class="hero__h2">
        <? echo __('Aus traditioneller Herstellung.', 'naegele'); ?>
      </h2>
    </div>
  </section>
  <div class="wrapper">
    <div class="grid--prod">
      <nav class="nav-prod">
        <div class="nav-prod__col">
          <ul class="nav-prod__items">
            <?php

              $args = array(
                'taxonomy' => 'product_category',
                'title_li' => '',
                'parent' => 0,
                'hide_empty' => false
              );

              $output = 'objects'; // or names
              $categories = wp_list_categories($args,$output);

              if  ($categories) {
                foreach ($categories  as $category ) {
                  echo '<p>' . $category->name . '</p>';
                }
              }

              wp_reset_query();
            ?>
          </ul>
        </div>
      </nav>
      <section class="products-container">
        <?

        $product_category_terms = get_terms(array('taxonomy' => 'product_category', 'parent' => 0));

        foreach ( $product_category_terms as $product_category_term ) {
            $product_category_query = new WP_Query( array(
                'post_type' => 'product',
                'posts_per_page' => 4,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_category',
                        'field' => 'slug',
                        'terms' => array( $product_category_term->slug ),
                        'operator' => 'IN'
                    )
                )
            ) );
            ?>

            <h3 class="product-category__name"><?php echo $product_category_term->name; ?></h3>
            <? if($product_category_term->description !== '') : ?>

                  <p><? echo $product_category_term->description; ?></p>

            <? endif; ?>

            <?php
            if ( $product_category_query->have_posts() ) : ?>

            <div class="product-row">
              <section class="products">

            <? while ( $product_category_query->have_posts() ) : $product_category_query->the_post();
                $img = get_field('product_image');
                $quantity = get_field('product_quantity');
                $categories = get_the_terms($post->ID, 'product_category');
              ?>
                    <article class="product <? echo $post->ID; ?>">
                      <a href="<? echo get_permalink(); ?>" class="product__link" title="<? echo __('Produkt anzeigen', 'naegele'); ?>">
                        <?
                          if ( has_post_thumbnail() ) {
                            the_post_thumbnail('product-thumb');
                          }
                        ?>
                        <h3 class="product__name">
                          <? echo $post->post_title; ?>
                          <span class="product__quantity">
                            <? echo $quantity ?>&nbsp;<span class="text--small">L</span>
                          </span>
                        </h3>
                      </a>
                    </article>
              <?php endwhile; ?>
            </section>
            <? if($product_category_query->found_posts > 4) : ?>
              <? if(ICL_LANGUAGE_CODE == "de") : ?>
                <div class="show-all"><a href="<? echo get_term_link($product_category_term, 'product_category'); ?>">Alle <? echo $product_category_term->name; ?> Produkte</a></div>
              <? endif; ?>
              <? if(ICL_LANGUAGE_CODE == "it") : ?>
                <div class="show-all"><a href="<? echo get_term_link($product_category_term, 'product_category'); ?>">Tutti prodotti <? echo $product_category_term->name; ?></a></div>
              <? endif; ?>
            <? endif; ?>
          </div>

          <? endif; ?>
            <?php
            // Reset things, for good measure
            $product_category_query = null;
            wp_reset_postdata();
        }
        ?>

      </section>
    </div>
  </div>
<? get_footer() ?>
