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
  if(c::get('develeopment')) {
    ?>
    <div class="breakpoint-debug device-xs visible-xs">xs</div>
    <div class="breakpoint-debug device-sm visible-sm">sm</div>
    <div class="breakpoint-debug device-md visible-md">md</div>
    <div class="breakpoint-debug device-lg visible-lg">lg</div>

    <script async type="text/javascript" src="<?= kirby()->urls()->assets() . "/compiled/script.js" ?>"></script>
    <?php
  }
  else {
    ?><script async type="text/javascript" src="<?= kirby()->urls()->assets() . "/compiled/script.min.js" ?>"></script><?php
  }
  ?>
  </body>
</html>
