<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>COOLING GROOLING</title>
    <link rel="stylesheet" href="./artStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="heade">
      <img src="../assets/images/cgnews.png">
      <div>
        <p> C THE NEWS</p>
      </div>
    </div>
    <div class="marquee">
      <div>
        <?php
      function hello() {
      }
        $dir = array_values(array_diff(scandir("./arts/"), array('.', '..', "index.php", ".gitkeep", ".gitignore")));
      $titles = array();
      $links = array();
      $images = array();
      foreach ($dir as $folder){
        $link = "./arts/" . $folder;
        $index = fopen($link . "/index.php", "r") or hello();
        if ($index != false){
            $text = fread($index, filesize("./arts/" .$folder . "/index.php"));
          $titleStart = strpos($text, "<h1>") + 4;
          $titleEnd = strpos($text, "</h1>");
          $imgStart = strpos($text, "<img");
          $imgEnd = strpos($text, ">", $imgStart);
          $img = substr($text, $imgStart, $imgEnd - $imgStart + 1);
          //$srcPos = strpos($img, "src=");
          $img = str_replace("..", ".", $img);
          $title = substr($text, $titleStart, $titleEnd - $titleStart);
          array_push($titles, $title);
          array_push($links, $link);
          array_push($images, $img);
        }
      }
          for($i = 0; $i< 3; $i++){
            for($j = 0; $j < count($links); $j++){
          ?>
            ||<a href="<?php echo $links[$j]?>/"> <?php echo $titles[$j] ?> </a>
          <?php
            }
          }
        ?>
      </div>
    </div>
    <div class="main">
      <img src="../assets/images/articles.png" style="width:100%">
      <br>
      <?php
          for($j = 0; $j < count($links); $j++){
          ?>
      <a class="article" href="<?php echo $links[$j]?>/"> 
        <?php echo $images[$j]; ?> 
        <p><?php echo $titles[$j] ?> </p>
      </a><?php
            }
      ?></div>
  </body>
<?php
include("bottom.php")
?>
