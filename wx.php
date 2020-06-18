<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta name="robots" content="noindex">
    <?php include 'includes/head.php';?>
  </head>
  <body>
    <?php
    $overtid = ' active';
    include 'includes/navbar.php';?>
    <div class="container">
      <div class="row">
        <div class="col-12 mt-3">
          <h1>METAR &amp; TAF</h1>
          <p class="lead">Senast tillgängliga observation</p>
            <div style="font-family:monospace;">
                <div class="checkwx-container" data-type="METAR" data-station="ESSD"></div>
                <div class="checkwx-container" data-type="TAF" data-station="ESSD"></div>
            </div>
          </div>
        </div>
      </div>
    <?php include 'includes/footer.php'; ?>
    <script type="text/javascript" src="https://api.checkwx.com/widgets/metartaf.js"></script>
  </body>
</html>
