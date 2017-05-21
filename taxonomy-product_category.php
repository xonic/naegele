<?

get_header() ?>
  <section class="hero">
    <div class="wrapper">
      <h1 class="hero__h1">
        <?php
          $queried_object = get_queried_object();
          echo $queried_object->name;;
          ?>
      </h1>
      <? if($queried_object->description !== '') : ?>

        <p class="product-category__description">
          <? echo $queried_object->description; ?>
        </p>

      <? endif; ?>
      <h2 class="hero__h2"><!--don't delete this h2--></h2>
    </div>
  </section>
  <div class="wrapper">
    <a class="nav-prod__show-all" href="<? echo esc_url(get_post_type_archive_link('product')); ?>">&lt; <? echo __('Alle Produkte', 'naegele'); ?></a>
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

        <?
        // Get the queried object (in this case check if certain product category is queried)
        $queried_object = get_queried_object();
        $term_children = get_terms($queried_object->taxonomy, array('child_of' => $queried_object->term_id));
        // var_dump($term_children);

        if($term_children) : ?>

          <section class="products-container">

        <?  foreach ( $term_children as $term_child ) {
              $term_children_query = new WP_Query( array(
                  'post_type' => 'product',
                  'posts_per_page' => 4,
                  'tax_query' => array(
                      array(
                          'taxonomy' => 'product_category',
                          'field' => 'slug',
                          'terms' => array( $term_child->slug ),
                          'operator' => 'IN'
                      )
                  )
              ));
          ?>

              <h3 class="product-category__name"><?php echo $term_child->name; ?></h3>
              <? if($term_child->description !== '') : ?>

                <p>
                  <? echo $term_child->description; ?>
                </p>

                <? endif;

                if ( $term_children_query->have_posts() ) : ?>

                        <div class="product-row">
                          <section class="products">

                            <? while ( $term_children_query->have_posts() ) : $term_children_query->the_post();
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
                          <? if($term_children_query->found_posts > 4) : ?>
                            <? if(ICL_LANGUAGE_CODE == "de") : ?>
                              <div class="show-all"><a href="<? echo get_term_link($term_child, 'product_category'); ?>">Alle <? echo $term_child->name; ?> Produkte</a></div>
                              <? endif; ?>
                          <? if(ICL_LANGUAGE_CODE == "it") : ?>
                            <div class="show-all"><a href="<? echo get_term_link($term_child, 'product_category'); ?>">Tutti prodotti <? echo $term_child->name; ?></a></div>
                            <? endif; ?>
                      <? endif; ?>
                    <? endif; ?>
              </div>

              <?
              // Reset things, for good measure
              $product_category_query = null;
              wp_reset_postdata();
          }

          else : ?>

          <section class="products">
            <?

        $tax_query = array(
                        array(
                            'taxonomy' => 'product_category', //or tag or custom taxonomy
                            'field' => 'slug',
                            'terms' => 'eigenmarken'
                        )
                    );;

        // if product category is queried, setup filter for custom post query
        if( $queried_object->slug != '') {
          $tax_query = array(
                          array(
                              'taxonomy' => 'product_category', //or tag or custom taxonomy
                              'field' => 'slug',
                              'terms' => $queried_object->slug
                          )
                      );
        }

        // Custom post query for products
        query_posts( array(
          'post_type' => 'product',
          'paged' => $paged,
          'posts_per_page' => 12,
          'tax_query' => $tax_query
        ) );

          if (have_posts()) :

            // Start the loop
            while (have_posts()) : the_post();

              $quantity = get_field('product_quantity');
              $categories = get_the_terms($post->ID, 'product_category');
              $child_cats = array();

              // Get only child categories of product (Exclude Eigenmarken)
              foreach ($categories as $cat) {
                if (0 != $cat->parent) {
                  $child_cats[] = $cat->name;
                }
              }
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
                <?
            endwhile;

            wp_reset_query();

          else :

            echo "No products found";

          endif;
          endif
        ?>

      </section>
    </div>
  </div>
  <? get_footer() ?>
