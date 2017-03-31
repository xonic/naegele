  <? get_header(); ?>

<? if( 'product' === get_post_type() && is_single()) : ?>
  <div class="wrapper">
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
      <? if(function_exists('bcn_display')) :
              bcn_display();
          endif;
      ?>
    </div>
  </div>
  <div class="hero">
    <div class="wrapper">
      <h1 class="hero__h1"><? the_title(); ?></h1>
      <h2 class="hero__h2">
        <?
         $category = get_the_terms($post->ID, 'product_category')[0]->name;
         echo $category;
        ?>
      </h2>
    </div>
  </div>
  <div class="wrapper">
    <section class="section--single-prod section">
      <div class="grid--single-prod">
        <div class="product__image">
          <? if (has_post_thumbnail()) :
               the_post_thumbnail('full');
             endif;
          ?>
        </div>
        <div class="product__content">
          <p><? the_field('product_description') ?></p>
          <p><? the_field('product_quantity') ?> <? echo __('Liter Flasche', 'naegele'); ?></p>
        </div>
      </div>
    </section>
    <section class="section section--alt">
      <h4 class="related__title"><? echo __('Weitere Produkte', 'naegele'); ?></h4>
      <div class="products">
        <?
        if ( function_exists( 'get_related_posts' ) ) {
            $related_posts = get_related_posts( 'product_category', ['posts_per_page' => 8] );
            if ( $related_posts ) {
                foreach ( $related_posts as $post ) {
                    setup_postdata( $post );
                    ?>

                    <article class="product <? echo $post->ID; ?>">
                      <a href="<? echo get_permalink(); ?>" class="product__link" title="<? echo __('Produkt anzeigen', 'naegele'); ?>">
                        <?
                          if ( has_post_thumbnail() ) {
                            the_post_thumbnail('product-thumb');
                          }
                        ?>
                        <h3 class="product__category">
                          <span>
                            <? echo get_the_terms($post->ID, 'product_category')[0]->name; ?>
                          </span>
                          <span class="product__quantity">
                            <? echo get_field('product_quantity') ?>&nbsp;<span class="text--small">L</span>
                          </span>
                        </h3>
                        <h4 class="product__name"><? echo $post->post_title; ?></h4>
                      </a>
                    </article>
                <?
                }
                wp_reset_postdata();
            }
        }
        ?>
      </div>
    </section>
  </div>

<? endif; ?>

<? get_footer() ?>
