<?php
$stamp = date('H_i_s');
$current = 'Senast uppdaterad: ' . $stamp;
$file = $stamp . '.txt';
file_put_contents($file, $current);
?>