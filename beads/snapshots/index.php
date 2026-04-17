<!DOCTYPE html> <html>
<head>
  <meta charset="UTF-8">
  <title>Beads TM</title>
  <link rel="stylesheet" href="../beadstyle.css">

</head>
<body>
<div class="snapmain">
<h1>Snapshots</h1>
<div class="goback">
<a href="../">Go back</a>
</div>
<div class="snapshots">
<?php
      $colors = ["#ffffff", "#000000", "#ff0000", "#ff8800", "#ffff00", "#00ff00", "#0088ff", "#bb22ff"];
    $files = array_values(array_diff(scandir("."), array('.', '..', "index.php", ".gitkeep", ".gitignore")));
    for($i = 0; $i < count($files); $i+=1){
      $file = $files[$i];
    ?>
        <div class="beads-base">
      <?php 
        $data = [[]];
        if (($handle = fopen($file, "r")) !== false) {
            while (($row = fgetcsv($handle, escape: "\\")) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
      for($x = 0; $x < count($data); $x+=1){
        for($y = 0; $y < count($data[$x]); $y+=1){
          ?>
        <div style="background-color:<?php echo $colors[$data[$x][$y]] ?>" class="bead">
          </div>
          <?php
          
        }
      } 
        ?>
        </div>
        <?php
    }
    ?>
    </div>
    </div>
</body>
