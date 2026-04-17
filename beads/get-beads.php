<?php
if (!file_exists("beads.csv")) {
    $handle = fopen("beads.csv", "w");
    for ($y = 1; $y <= 29; $y++) {
        $row = [];
        for ($x = 1; $x <= 29; $x++) {
            $row[$x] = 0;
        }
        fputcsv($handle, $row);
    }
}
$handle = fopen("beads.csv", "r");
echo fread($handle, 10000);