<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta name="robots" content="noindex">
    <?php include '../includes/head.php';?>
  </head>
  <body>
    <?php
    $sbi = ' active';
    include '../includes/navbar.php';
    
    // Set timezone
    date_default_timezone_set('Europe/Stockholm');
    define('DATES', getDates());
    //https://xpider.sj.se/vkv42.php?datum=2018-10-31&persID=11395
    define('LINK', ['https://xpider.sj.se/vkv42.php?datum=', '&persID=']);

    // Returns array with today and 5 following dates.
    function getDates() {
        // Current date
        $date = date('Y-m-d');

        for ($i = 0; $i < 6; $i++) {
            $date = strtotime("+$i day");
            $out[$i] = date('Y-m-d', $date);
        }

        return $out;
    } 
    ?>
    <div class="container" style="font-family: monospace;">
      <div class="row">
        <div class="col text-center">
          <p class="mb-0 mt-2">Ny sida: 
            <a href="https://hermansson.xyz/sbi/">hermansson.xyz/sbi</a> (lösenord: gr!s)
          </p>
        </div>
      </div>
     
      <?php
      // Repeat for each day
      for ($i = 0; $i < 6; $i++) { ?> 
      <div class="row">
        <div class="col" style="font-family: monospace; font-size: 1.2rem;">
          <table class="mx-auto text-right">
            <tr>
              <th colspan="2" class="text-center"><?php echo DATES[$i]; ?></th>
            </tr>
            <tr>
              <td>JOTR</td>
              <td><a href="https://xpider.sj.se/vkv42.php?datum=<?php echo DATES[$i]; ?>&persID=11270" target="_blank">
                <img src="https://hermansson.xyz/sbi/img/11270_<?php echo $i; ?>.png?ver=<?php echo date('Ymdhis'); ?>" class="img-fluid" /></a></td>
            </tr>
            <tr>
              <td>ERBE</td>
              <td><a href="https://xpider.sj.se/vkv42.php?datum=<?php echo DATES[$i]; ?>&persID=11370" target="_blank">
                <img src="https://hermansson.xyz/sbi/img/11370_<?php echo $i; ?>.png?ver=<?php echo date('Ymdhis'); ?>" class="img-fluid" /></a></td>
            </tr>
            <tr>
              <td>MAHE</td>
              <td><a href="https://xpider.sj.se/vkv42.php?datum=<?php echo DATES[$i]; ?>&persID=11395" target="_blank">
                <img src="https://hermansson.xyz/sbi/img/11395_<?php echo $i; ?>.png?ver=<?php echo date('Ymdhis'); ?>" class="img-fluid" /></a></td>
            </tr>
            <tr>
              <td>JIRI</td>
              <td><a href="https://xpider.sj.se/vkv42.php?datum=<?php echo DATES[$i]; ?>&persID=12260" target="_blank">
                <img src="https://hermansson.xyz/sbi/img/12260_<?php echo $i; ?>.png?ver=<?php echo date('Ymdhis'); ?>" class="img-fluid" /></a></td>
            </tr>
          </table>
        </div>
      </div>      
      <?php
        } ?>      
    </div>
    <?php include '../includes/footer.php'; ?>
  </body>
</html>