<?php
$choiceId = escapeshellarg($_GET["id"])
$output = shell_exec("python3 ./map/edit/remove.py")

echo "Output from Python: " . $output;
?>
