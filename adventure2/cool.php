<?php
// Escape arguments for security!!!
$xParam = escapeshellarg($_POST["x"]);
$yParam = escapeshellarg($_POST["y"]);

$output = shell_exec("python3 ./map/edit/edit.py " . $xParam . " " . $yParam);

echo "Output from Python: " . $output;
?>