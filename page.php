<? get_header(); ?>
    <? if( is_page()) : ?>
      <main class="main">
        <section class="hero">
          <div class="wrapper">
            <h1 class="hero__h1"><? the_title(); ?></h1>
            <h2 class="hero__h2"></h2>
          </div>
        </section>
        <div class="wrapper">
          <div class="section--privacy section">
            <div class="news__wrapper">
              <? the_content(); ?>
            </div>
          </div>
        </div>
      </main>
    <? endif; ?>
<? get_footer(); ?>
