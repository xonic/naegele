<?
/* Template Name: Über uns */

get_header() ?>

  <section class="section news">
    <div class="wrapper">
      <?
        query_posts('posts_per_page=2');

        if (have_posts()) : ?>

        <h2 class="section__title is-hidden">Neuigkeiten</h2>
        <div class="news__grid">

      <?  // Start the loop
          while (have_posts()) : the_post(); ?>

            <article class="news__item">
              <h3 class="news__title"><? the_title(); ?></h3>
              <? the_content(); ?>
            </article>
      <?
          endwhile;

          wp_reset_query();
      ?>
      </div>
      <a class="btn" href="">Weitere Neuigkeiten anzeigen</a>
      <?
        else :

          echo "No posts found";
          echo "</div>";

        endif;
      ?>
    </div>
  </section>
  <section class="shop section section--alt">
    <div class="wrapper">
      <div class="section__titles">
        <h2 class="section__title">Der Getränkemarkt</h2>
        <h3 class="section__subtitle">In neuem Licht.</h3>
      </div>
      <div class="shop__grid section__grid">
        <div class="shop__img section__img">
          <img src="<? bloginfo('template_directory'); ?>/assets/img/shop.jpg" alt="Der Nägele Getränkemarkt">
        </div>
        <div class="shop__content section__content">
          <ul>
            <li>Moderne Architektur</li>
            <li>500m² Verkaufsfläche</li>
            <li>Vergrößertes Sortiment</li>
            <li>Vinothek und Spezialitäten</li>
            <li>Vielfalt an internationalen Biersorten</li>
            <li>Verkostung und persönliche Beratung</li>
            <li>Helles, angenehmes Ambiente</li>
            <li>Zahlreiche Parkplätze</li>
          </ul>
          <a class="btn" href>360° virtuellen Rundgang starten</a>
        </div>
      </div>
    </div>
  </section>
  <section class="production section">
    <div class="wrapper">
      <div class="section__titles">
        <h2 class="section__title">Herstellung</h2>
        <h3 class="section__subtitle">Tradition neu erleben.</h3>
      </div>
      <div class="section__grid production__grid">
        <div class="production__img section__img">
          <img src="<? bloginfo('template_directory'); ?>/assets/img/bottles.jpg" alt="Nägele Flaschen auf dem Fließband">
        </div>
        <div class="production__content section__content">
          <p>In 100 Jahren Entwicklungsprozess, Innovation und Automatisierung ist ein Grundgedanke immer unser Leitfaden geblieben: Getränke von höchster Qualität herzustellen, die den Wünschen unserer Kunden entsprechen.</p>

          <p>Was hier abgefüllt wird, ist ein reines Geschmackserlebnis. Mit neuen, eigenen Produkten garantiert Firma Nägele höchste Qualität unter ausschließlicher Verwendung auserlesener Rohstoffe. Durch die sorgfältige und schonende Verarbeitung bleiben die natürlichen Aromen und der volle Geschmack der sonnengereiften Früchte erhalten.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="section section--alt recycling">
    <div class="wrapper">
      <div class="section__titles">
        <h2 class="section__title">Mehrweg</h2>
        <h3 class="section__subtitle">Der Umwelt zuliebe.</h3>
      </div>
      <div class="section__grid recycling__grid">
        <div class="recycling__img section__img">
          <img src="<? bloginfo('template_directory'); ?>/assets/img/case.jpg" alt="Eine Nägele Kiste">
        </div>
        <div class="recycling__content section__content">
          <p>Wer über ein Jahrhundert lang den Durst löscht, legt Wert auf den gewissen Unterschied, um höchsten Ansprüchen mehr als gerecht zu werden. Mit wachsamen Augen, Flasche für Flasche.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="section partner">
    <div class="wrapper">
      <h2 class="section__title">Unsere Partner</h2>
      <h3 class="section__subtitle">Gemeinsam löschen wir Ihren Durst.</h3>
      <div class="partner__content">
        <ul>
          <li>Partner 1</li>
          <li>Partner 2</li>
          <li>...</li>
        </ul>
      </div>
    </div>
  </section>
  <section class="section section--alt team">
    <div class="wrapper">
      <h2 class="section__title">Unser Team</h2>
      <h3 class="section__subtitle">Wir beraten Sie gerne.</h3>
      <div class="team__content">
        <ul>
          <li>Mitarbeiter 1</li>
          <li>Mitarbeiter 2</li>
          <li>...</li>
        </ul>
      </div>
    </div>
  </section>
<? get_footer() ?>
