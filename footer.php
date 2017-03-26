    </main>
    <footer class="footer">
      <div class="section">
        <div class="wrapper">
          <section class="contact">
            <h2 class="section__title">Kontakt</h2>
            <h3 class="section__subtitle">Wo und wie Sie uns erreichen.</h3>
            <p>Nägele K. &amp; A. GmbH</p>
            <p>Weingartnerstraße 14<br>
               39022 Algund (BZ)<br>
               Italien
            </p>
            <p><a href="https://goo.gl/maps/3jQJYh3dkMr" target="_blank">Auf Google Maps anzeigen</a></p>
            <p>Tel: 0473 447 877<br>
               Fax: 0473 447 826<br>
               Email: <a href="mailto:info@naegele.it">info@naegele.it</a>
            </p>
            <p>
              Eingetragen im Register der Handelskammer Bozen<br>
              Nr: BZ-64899<br>
              MwSt.-Nr: IT 00126160217
            </p>
            <p class="social">
              <a class="social__link" href="https://www.facebook.com/naegeledrink/">
                <img class="social__img" src="<? bloginfo('template_directory'); ?>/assets/img/i--fb.svg">
              </a>
              <a class="social__link" href="https://www.looptown.com/de/algund/naegele-k-a-gmbh">
                <img class="social__img" src="<? bloginfo('template_directory'); ?>/assets/img/i--looptown.png">
              </a>
            </p>
            <p><a href="<?php echo get_permalink( get_page_by_path( 'privacy' ) ); ?>">Datenschutzrichtlinien anzeigen</a></p>
          </section>
          <section class="newsletter">
            <h2 class="section__title">Newsletter</h2>
            <h3 class="section__subtitle">Immer auf dem letzten Stand.</h3>
            <a class="btn link--newsletter" href="">Jetzt anmelden</a>
          </section>
        </div>
      </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
    <script src="<? bloginfo('template_directory'); ?>/assets/js/custom/main.js"></script>
  </body>
  <? wp_footer(); ?>
</html>
