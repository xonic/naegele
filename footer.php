    </main>
    <footer class="footer">
      <div class="section">
        <div class="wrapper">
          <? if(is_active_sidebar('footer-sidebar-1')) :

              dynamic_sidebar('footer-sidebar-1');

             endif; ?>
          <? if(is_active_sidebar('footer-sidebar-2')) :

              dynamic_sidebar('footer-sidebar-2');

             endif; ?>
        </div>
        <div class="wrapper">
        <? if(ICL_LANGUAGE_CODE == "de") : ?>
            <p><a href="<?php echo get_permalink( get_page_by_path( 'privacy' ) ); ?>">Datenschutzrichtlinien anzeigen</a></p>
          <? endif; ?>
          <? if(ICL_LANGUAGE_CODE == "it") : ?>
          <p><a href="<?php echo get_permalink( get_page_by_path( 'privacy' ) ); ?>">Privacy</a></p>
        <? endif; ?>
        </div>
      </div>
    </footer>
    <div class="main">
      <section class="privacy section section--alt">
        <div class="wrapper">
          <? if(ICL_LANGUAGE_CODE == "de") : ?>
              <div>
                Nägele verwendet <a href="<? echo get_permalink( get_page_by_title( 'Datenschutzrichtlinien' ) ); ?>">Cookies</a>, um Ihnen den bestmöglichen Service zu gewährleisten. Wenn Sie auf der Seite weitersurfen stimmen Sie der Cookie-Nutzung zu.
              </div>
              <div><a href id="js-accept-cookies" class="btn">Ich stimme zu</a></div>
          <? endif; ?>
          <? if(ICL_LANGUAGE_CODE == "it") : ?>
              <div>
                Per offrirti il miglior servizio possibile Nägele utilizza <a href="<? echo get_permalink( get_page_by_title( 'Privacy' ) ); ?>">cookies di terzi</a>. Continuando la navigazione nel sito autorizzi l’uso dei cookies.
              </div>
              <div><a href id="js-accept-cookies" class="btn">Sono d‘accordo</a></div>
          <? endif; ?>
        </div>
      </section>
    </div>
    <script src="<? bloginfo('template_directory'); ?>/assets/js/custom/main.js"></script>
  </body>
  <? wp_footer(); ?>
</html>
