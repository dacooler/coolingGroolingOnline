<?php
if (!file_exists("beads.csv")) {
    $handle = fopen("beads.csv", "w");
    if (flock($handle, LOCK_EX)){
      for ($y = 1; $y <= 30; $y++) {
          $row = [];
          for ($x = 1; $x <= 30; $x++) {
              $row[$x] = 0;
          }
          fputcsv($handle, $row);
      }
    }
    fclose($handle);
}
$handle = fopen("beads.csv", "r");
if (flock($handle, LOCK_EX)){
  echo fread($handle, 10000);
}
