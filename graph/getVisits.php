<?php
function getVisits() {
    $dates = array();
    if (($handle = fopen("count.csv", "r")) != FALSE) {
        while (($data = fgetcsv($handle, 1000, ",", "\"", "\\")) !== FALSE) {
            $dates[$data[0]] = (int) $data[1];
        }
    }

    $today = date("Y-m-d");
    $count = 1;
    if (array_key_exists($today, $dates)) {
        $count += $dates[$today];
    }
    $dates[$today] = $count;

    if (($handle = fopen("count.csv", "w")) != FALSE) {
        foreach ($dates as $key => $value) {
            fputcsv($handle, array($key, $value), ",", "\"", "\\");
        }
    }

    return $dates;
}
?>
