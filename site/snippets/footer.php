  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="copyright">
          <?php echo $site->copyright() ?>
        </div>

        <div class="colophon">
          <a href="http://getkirby.com/made-with-kirby-and-love" target="_blank">Made with Kirby </a>and <b>♥</b>
        </div>
      </div>
    </div>
  </footer>

  <div class="breakpoint-debug device-xs visible-xs">xs</div>
  <div class="breakpoint-debug device-sm visible-sm">sm</div>
  <div class="breakpoint-debug device-md visible-md">md</div>
  <div class="breakpoint-debug device-lg visible-lg">lg</div>

  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/lib/jquery.min.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/lib/pace/pace.min.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/lib/fittext.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/lib/scrollTo.min.js" ?>"></script>

  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/js/unveil.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/js/packery.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/js/ux.js" ?>"></script>
  </body>
</html>
