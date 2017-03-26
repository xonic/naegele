<? get_header() ?>
    <? if (has_posts()) : ?>

      <? while(has_posts()) : the_post() ?>

        <h1><? the_title(); ?></h1>

        <? the_content(); ?>

      <? endwhile; ?>

    <? endif; ?>
<? get_footer() ?>
