  <footer class="footer cf" role="contentinfo">

    <div class="copyright">
      <?php echo $site->copyright()->kirbytext() ?>
    </div>

    <div class="colophon">
      <a href="http://getkirby.com/made-with-kirby-and-love">Made with Kirby and <b>♥</b></a>
    </div>

  </footer>

  <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/js/infinity.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/js/lazyload.js" ?>"></script>
  <script type="text/javascript" src="<?= kirby()->urls()->assets() . "/js/ux.js" ?>"></script>
</body>
</html>
