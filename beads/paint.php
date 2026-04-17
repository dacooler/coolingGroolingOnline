<?php
$args = json_decode(file_get_contents("php://input"), true);
if (isset($args['x']) && isset($args['y']) && isset($args['color'])) {
    $x = $args['x'];
    $y = $args['y'];
    $color = $args['color'];

    if (!is_numeric($x) || !is_numeric($y) || !is_numeric($color) ||
        intval($x) != $x || intval($y) != $y || intval($color) != $color) {
        die("Invalid input: x, y, and color must all be integers");
    }

    $data = [];
    $beadsFileName = "beads.csv";
    $snapshotFolder= "snapshots/";

    if (($handle = fopen($beadsFileName, "r")) !== false) {
        while (($row = fgetcsv($handle, escape: "\\")) !== false) {
            $data[] = $row;
        }
        fclose($handle);
    }

    if (isset($data[$y][$x])) {
        $data[$y][$x] = $color;
    } 

    if (($handle = fopen($beadsFileName, "w")) !== false) {
        foreach ($data as $row) {
            fputcsv($handle, $row, escape: "\\");
        }
        fclose($handle);
    }
    copy($beadsFileName, $snapshotFolder . date("W") . ".csv");
}
?>
