<?php
$namn = $anst = $kost = $ort = $person = $punkt = $datum = $filnamn = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["punkt"])) {exit;}
    $punkt = test_input($_POST["punkt"]);
    $namn = test_input($_POST["namn"]);
    $anst = test_input($_POST["anst"]);
    $kost = test_input($_POST["kost"]);
    $ort = test_input($_POST["ort"]);
    $person = test_input($_POST["person"]);
    $datum = test_input($_POST["datum"]);
    $filnamn = test_input($_POST["filnamn"]);
    $komp = test_input($_POST["komp"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$punktlighet = array(array());

# UNIVERSALLÖSNING 0.1.0 regex \d{4}-\d{2}-\d{2}
$punktdel = preg_split("/[\s]+/", $punkt);
$row_count = -1;
$del_count = 0;
for ($i = 0; $i < sizeof($punktdel); $i++) {
  if (preg_match("/\d{4}-\d{2}-\d{2}/", $punktdel[$i])) {
    $row_count++;
    $del_count = 0;
  }
  $punktlighet[$row_count][$del_count++] = $punktdel[$i];
}

header("Content-type:application/rtf");
header("Content-Disposition:attachment;filename='" . $filnamn . ".rtf'");

$blankett = file_get_contents('mall.rtf');
$inlaga = file_get_contents('mall_inlaga.rtf');
$tagforsening = "T\u229\'e5gf\u246\'f6rsening "; //RTF-format för Tågförsening
$aao = array('å', 'ä', 'ö', 'Å', 'Ä', 'Ö');
$aao_replace = array("\u229\'e5", "\u228\'e4", "\u246\'f6", "\u197\'c5", "\u196\'c4", "\u214\'d6");


$counter = 1;

for ($i = sizeof($punktlighet) - 1; $i > -1; $i--) {
  if ($counter == 6 && !empty($punktlighet[$i][6]) && $punktlighet[$i][6] < 0) { // Lägg till ny sida
    $blankett = str_replace("%%INLAGA%%", $inlaga, $blankett);
    $counter = 1;
  }
  if (!empty($punktlighet[$i][6]) && $punktlighet[$i][6] < 0) {
      $blankett = str_replace("%%DATUM$counter%%", substr($punktlighet[$i][0], 2), $blankett);
      $blankett = str_replace("%%TUR$counter%%", $punktlighet[$i][1], $blankett);
      $blankett = str_replace("%%TAGNR$counter%%", $punktlighet[$i][2], $blankett);
      $blankett = str_replace("%%FROM$counter%%", $punktlighet[$i][3], $blankett);
      $blankett = str_replace("%%TOM$counter%%", $punktlighet[$i][4], $blankett);
      $blankett = str_replace("%%KOMP$counter%%", $komp, $blankett);
      $blankett = str_replace("%%VANK$counter%%", $punktlighet[$i][5], $blankett);
      $blankett = str_replace("%%OVR$counter%%",
      $tagforsening . $punktlighet[$i][6], $blankett);
      $counter++;
  }
}

# Fyll i alla personuppgifter
$blankett = str_replace("%%NAMN%%", $namn, $blankett);
$blankett = str_replace("%%ANSTNR%%", $anst, $blankett);
$blankett = str_replace("%%KOSTNAD%%", $kost, $blankett);
$blankett = str_replace("%%ORT%%", $ort, $blankett);
$blankett = str_replace("%%PERSONNR%%", $person, $blankett);

# Fyll i datum
$blankett = str_replace("%%DATUM%%", $datum, $blankett);
# Ta bort kvarvarande placeholders
$blankett = preg_replace("/%%.*?%% ?/", "", $blankett);
# Fixa åäöÅÄÖ
$blankett = str_replace($aao, $aao_replace, $blankett);

echo $blankett;

?>
