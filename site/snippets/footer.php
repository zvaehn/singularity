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
  // Development mode
  if(c::get('development')) {
    ?>
    <div class="breakpoint-debug device-xs visible-xs">xs</div>
    <div class="breakpoint-debug device-sm visible-sm">sm</div>
    <div class="breakpoint-debug device-md visible-md">md</div>
    <div class="breakpoint-debug device-lg visible-lg">lg</div>

    <script async type="text/javascript" src="<?= kirby()->urls()->assets() . "/compiled/script.js" ?>"></script>
    <?php
  }
  // Live mode
  else {
    $jsfile = kirby()->roots()->assets() . "/compiled/script.min.js";
    $jsfiletime = filemtime($jsfile);
    $jsurl = kirby()->urls()->assets() . "/compiled/script.min.js?v=" . md5($jsfiletime);

    if($site->analytics()->exists()) {
      ?>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','<?= $jsurl ?>','ga');

        var GA_LOCAL_STORAGE_KEY = 'ga:clientId';

        if (window.localStorage) {
          ga('create', '<?= $site->analytics()->value() ?>', {
            'storage': 'none',
            'clientId': localStorage.getItem(GA_LOCAL_STORAGE_KEY)
          });
          ga(function(tracker) {
            localStorage.setItem(GA_LOCAL_STORAGE_KEY, tracker.get('clientId'));
          });
        }
        else {
          ga('create', '<?= $site->analytics()->value() ?>', '<?= $site->url() ?>');
        }

        ga('send', 'pageview');
      </script>
    <?php
    }
    else {
      ?>
      <script async type="text/javascript" src="<?= $jsurl ?>"></script>
      <?php
    }
  }

  // Force php session cookie removal
  setcookie('PHPSESSID','value',time()-1);
  ?>
  </body>
</html>
