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
         echo get_the_terms($post->ID, 'product_category')[0]->name;
        ?>
      </h2>
    </div>
  </div>
  <div class="wrapper">
    <div class="grid--single-prod">
      <div class="product__image">
        <? if (has_post_thumbnail()) :
             the_post_thumbnail('full');
           endif;
        ?>
      </div>
      <div class="product__content">
        <p><? the_field('product_description') ?></p>
        <p><? the_field('product_quantity') ?> <? echo __('Liter Flasche'); ?></p>
      </div>
    </div>
  </div>

<? endif; ?>

<? get_footer() ?>
