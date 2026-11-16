<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../styles/ThreeDStyle.css">
  <link rel="stylesheet" href="gaming.css">
</head>

<body>
  <div class="room">
    <div class="wall">
    </div>
    <div class="floor">
      <div class="machinegrid">
      <?php
      $dir = array_values(array_diff(scandir("./games/"), array('.', '', '..', "index.php", ".gitkeep", ".gitignore")));
      for ($i= 0; $i <= count($dir) - 1; $i++){
      ?>
      
      <div class="cubed machine" style="">
        <div class="front">
        </div>
        <div>
        </div>
        <div>
          <div class="machine-right"></div>
        </div>
        <div>
          <div class="machine-left"></div>
        </div>
        <div>
          <div class="controlpad">
          </div>
          <div class="cubed machine-upper">
            <div>
              <div class="cubed machine-lip">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div class="display"  style="background-image: url('./games/<?php echo $dir[$i] . "/lip.png";?>')"></div>
                <div></div>
              </div>
              <div class="screen-holder">
                <div class="screen">
                  <a href="./games/<?php echo $dir[$i] . "/game/"; ?>" style="background-image: url('./games/<?php echo $dir[$i] . "/image.png";?>')">
                  </a>
                </div>
              </div>
            </div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
        <div>
        </div>
        <div>
        </div>
      </div>
          
      <?php
      }
      ?>
      </div>
      </div>
    </div>
</body>

</html>
