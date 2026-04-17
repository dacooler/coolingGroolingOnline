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
    $colors = ["#ECE9E3", "#202020", "#7A5C95", "#433264", "#0F9DC8", "#D80F19", "#62615E", "#154171", "#10ACB5", "#E7B310", "#868583", "#8A5534", "#EE3710", "#743C2E", "#C13F18", "#E49457", "#105832", "#DE448C", "#209F49", "#E2C58B"];
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
