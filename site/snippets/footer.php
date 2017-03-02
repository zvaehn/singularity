  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="copyright">
          <?= $site->copyright()->kirbytext() ?>
        </div>

        <div class="colophon">
          <a href="http://getkirby.com/made-with-kirby-and-love" target="_blank">Made with Kirby </a>and <b>♥</b>
        </div>
      </div>
    </div>
  </footer>

  <?php
  if(c::get('development')) {
    ?>
    <div class="breakpoint-debug device-xs visible-xs">xs</div>
    <div class="breakpoint-debug device-sm visible-sm">sm</div>
    <div class="breakpoint-debug device-md visible-md">md</div>
    <div class="breakpoint-debug device-lg visible-lg">lg</div>

    <script async type="text/javascript" src="<?= kirby()->urls()->assets() . "/compiled/script.js" ?>"></script>
    <?php
  }
  else {
    if($site->analytics()->exists()) {
    ?>
      <script async type="text/javascript" src="<?= kirby()->urls()->assets() . "/compiled/script.min.js" ?>"></script>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','<?= url("assets/compiled/script.min.js") ?>','ga');
        ga('create', '<?= $site->analytics()->value() ?>', '<?= $site->url() ?>');
        ga('send', 'pageview');
      </script>
    <?php
    }
  }
  ?>
  </body>
</html>
