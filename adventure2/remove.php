<head>
<meta http-equiv="refresh" 
          content="1; url =./edit.html" />
</head>
<?php
$choiceId = escapeshellarg($_GET["id"]);
$output = shell_exec("python3 ./map/edit/remove.py " . $choiceId);
$output2 = shell_exec("python3 ./make.py");


echo "Output from Python: " . $output . $output2;
?>
