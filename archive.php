<?

get_header() ?>
  <section class="hero">
    Archive für News
    <div class="wrapper">
      <!-- <h1 class="hero__h1">
        Die besten Produkte
      </h1>
      <h2 class="hero__h2">
        Aus traditioneller Herstellung.
      </h2> -->
    </div>
  </section>
  <div class="grid--prod wrapper">
    <!-- <nav class="nav-prod">
      <div class="nav-prod__col">
        <h2 class="nav-prod__title"><? echo __('Unsere Produkte'); ?></h2>
        <ul class="nav-prod__items">
          <?php

            $term = get_term_by('slug', 'eigenmarken', 'product_category');
            $args=array(
              'taxonomy' => 'product_category',
              'title_li' => '',
              'child_of' => $term->term_id,
              'hide_empty' => false
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

            $term = get_term_by('slug', 'fremdmarken', 'product_category');
            $args=array(
              'taxonomy' => 'product_category',
              'title_li' => '',
              'child_of' => $term->term_id,
              'hide_empty' => false
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
      // Get the queried object (in this case check if certain product category is queried)
      $queried_object = get_queried_object();
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
        'posts_per_page' => 80,
        'tax_query' => $tax_query
      ) );

        if (have_posts()) :

          // Start the loop
          while (have_posts()) : the_post();

            $img = get_field('product_image');
            $quantity = get_field('product_quantity');
            $categories = get_the_terms($post->ID, 'product_category');
            $child_cats = array();

            // Get only child categories of product (Exclude Eigenmarken)
            foreach ($categories as $cat) {
              if (0 != $cat->parent) {
                $child_cats[] = $cat->name;
              }
            }

            // print_r($child_cats);
            // print_r($categories);
          ?>

            <article class="product <? echo $post->ID; ?>">
              <a href="<? echo get_permalink(); ?>" class="product__link" title="<? echo __('Produkt anzeigen'); ?>">
                <?
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail('product-thumb');
                  }
                ?>
                <h3 class="product__category">
                  <span>
                    <? echo array_pop($child_cats); ?>
                  </span>
                  <span class="product__quantity">
                    <? echo $quantity ?>&nbsp;<span class="text--small">L</span>
                  </span>
                </h3>
                <h4 class="product__name"><? echo $post->post_title; ?></h4>
              </a>
            </article>
      <?
          endwhile;

          wp_reset_query();

        else :

          echo "No products found";

        endif;
      ?> -->
    </section>
  </div>
<? get_footer() ?>
