        <div class="heade">
                <a href="../../"><img src="../../../assets/images/cgnews.png"></a>
                <div>
                        <p> C THE NEWS</p>
                </div>
        </div>
    <div class="marquee">
      <div>
        <?php
      function hello() {
      }
        $dir = array_values(array_diff(scandir(".."), array('.', '..', "index.php", ".gitkeep", ".gitignore")));
      $titles = array();
      $links = array();
      $images = array();
      foreach ($dir as $folder){
        $link = "../" . $folder;
        $index = fopen($link . "/index.php", "r") or hello();
        if ($index != false){
            $text = fread($index, filesize("../" .$folder . "/index.php"));
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
  </div>
