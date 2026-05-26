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
<a href="../">Go back</a><br><input id="flip" type="checkbox">Flip the BEADS</input>
</div>
<div class="snapshots">
<?php
    $colors = ["#ECE9E3", "#353535", "#a287b9", "#7f548e", "#6db4c9", "#de262f", "#93928f", "#23578e", "#71d4b0", "#efd034", "#c0bfbe", "#d59871", "#ff7b17", "#a76555", "#e8734f", "#f4c29b", "#147240", "#f15ca1", "#8cd85c", "#fae5bc"];
    $files = array_values(array_diff(scandir("."), array('.', '..', "index.php", ".gitkeep", ".gitignore")));
    for($i = 0; $i < count($files); $i+=1){
      $file = $files[$i];
    ?>
  <div class="backgr">
    <div class="beads-base">
      <?php 
        $data = [[]];
        if (($handle = fopen($file, "r")) !== false) {
          if (flock($handle, LOCK_EX)){
            while (($row = fgetcsv($handle, escape: "\\")) !== false) {
                $data[] = $row;
            }
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
    <div class="beads-back">
      <?php 
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
        </div>
        <?php
      }
      ?>
      </div>
    </div>
  <button onclick="flipTheBeads();">
    FLIP THE BEADS
  </button>
</body>
