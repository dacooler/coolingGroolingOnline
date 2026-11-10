<?php
// Escape arguments for security!!!
$furnitureParam = escapeshellarg($_POST["furniture"]);
$xParam = escapeshellarg($_POST["x"]);
$yParam = escapeshellarg($_POST["y"]);
$rotationParam = escapeshellarg($_POST["rotation"]);

$output = shell_exec("python3 ./map/edit/edit.py " . $furnitureParam . " " . $xParam . " " . $yParam . " " . $rotationParam);
$output = shell_exec("python3 ./make.py");

echo "Output from Python: " . $output;
?>
