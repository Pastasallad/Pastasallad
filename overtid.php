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
      <div class="row mt-3">
        <div class="col-12">
          <h1 class="display-3">Övertid</h1>
          <p class="lead">Uppgift om ändrad tjänstgöring</p>
          <form name="ovtd" method="post" action="overtid/process.php" onsubmit="return validateForm()">
            <div class="row">
              <div class="col-md-6 pr-md-1">
                <input type="text" name="namn" class="form-control mt-1" placeholder="Namn" maxlength="40">
              </div>
              <div class="col-md-6 pl-md-0">
                <input type="text" name="anst" class="form-control mt-1" placeholder="Anställningsnummer (10 siffror)" maxlength="12">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-md-1">
                <input type="number" name="kost" class="form-control mt-1" placeholder="Kostnadsställe" min="0" max="9999">
              </div>
              <div class="col-md-4 pl-md-0 pr-md-1">
                <input type="text" name="ort" class="form-control mt-1" placeholder="Stationeringsort" maxlength="15">
              </div>
              <div class="col-md-4 pl-md-0">
                <input type="text" name="person" class="form-control mt-1" placeholder="Personnummer (10 siffror)" maxlength="11">
              </div>
            </div>
            <textarea name="punkt" class="form-control mt-1" style="font-family:monospace;" placeholder="Klistra in punktlighetsdata här"
            rows="10" required></textarea>
            <div class="input-group mt-1">
              <div class="input-group date" id="datetimepicker1">
                <div class="input-group-prepend">
                  <div class="input-group-text">Datum</div>
                </div>
                <input type="text" name="datum" class="form-control" value="<?php echo date('Y-m-d');?>">
                <div class="input-group-append">
                  <div class="input-group-text"><i class="fa fa-calendar-o"></i></div>
                </div>
              </div>
            </div>
            <div class="input-group mt-1">
              <div class="input-group-prepend">
                  <div class="input-group-text">Filnamn</div>
                </div>
              <input type="text" name="filnamn" class="form-control" value="<?php echo 'Overtid-' . date('ymd');?>" maxlength="40" required>
              <div class="input-group-append">
                <div class="input-group-text">.rtf</div>
              </div>
            </div>
            <div class="input-group mt-1">
              <div class="input-group-prepend">
                  <div class="input-group-text">Kompensation</div>
                </div>
              <div class="form-control">
                <label class="radio-inline ml-3">
                  <input type="radio" name="komp" value="P" class="form-check-input" checked> Pengar
                </label>
                <label class="radio-inline ml-4 mr-0">
                  <input type="radio" name="komp" value="T" class="form-check-input"> Tid
                </label>
              </div>
            </div>
            <div id="punktAlert" class="collapse alert alert-danger mt-2">
              <strong>Punktlighet</strong> Felaktigt format!
            </div>
            <div class="text-center">
              <button type="reset" class="btn btn-warning btn-lg mt-3" onclick="hideErr()"><i class="fa fa-file-o"></i> Rensa formulär</button>
              <button type="submit" class="btn btn-success btn-lg mt-3"><i class="fa fa-file-text-o"></i> Hämta blankett</button>
            </div>
          </form>
          <div class="card mt-5">
            <div class="card-header">
              <i class="fa fa-info-circle fa-lg" style="color:#5bc0de;"></i> Information
            </div>
            <div class="card-body">
              <p class="card-text"><i class="fa fa-angle-double-right"></i> Punktlighetsdata är det enda obligatoriska fältet.</p>
              <p class="card-text"><i class="fa fa-angle-double-right"></i> Ingen information sparas.</p>
              <p class="card-text"><i class="fa fa-angle-double-right"></i> Den ifyllda blanketten laddas ned i formatet &lt;.rtf&gt;
              och går att öppna i valfri texteditor för att göra egna ändringar eller skriva ut.</p>
              <a href="https://www.libreoffice.org/" class="btn btn-info mt-2" target="_blank">LibreOffice<i class="fa fa-external-link ml-2"></i></a>
              <a href="https://www.openoffice.org/" class="btn btn-info mt-2" target="_blank">OpenOffice<i class="fa fa-external-link ml-2"></i></a>
              <a href="https://www.office.com/" class="btn btn-info mt-2" target="_blank">Microsoft Office<i class="fa fa-external-link ml-2"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function validateForm() {
        if (document.forms["ovtd"]["punkt"].value.search(/\d{4}-\d{2}-\d{2}/) < 0) {
          $("#punktAlert").collapse('show');
          return false;
        } else {
          $("#punktAlert").collapse('hide');
        }
      }
      function hideErr() {
        $("#punktAlert").collapse('hide');
      }
    </script>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
