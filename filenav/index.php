<!DOCTYPE html>
<html>
<head>
  <!-- <meta http-equiv="refresh" content="5"> -->
  <link rel="stylesheet" href="/styles/ThreeDStyle.css">
  <style>
    <?php
      $dir = scandir(".");
    ?>
    body{
      --posY: 0;
      overflow: hidden;
      background-image: url("/assets/images/sky.jpg")
    }
    h1{
      text-shadow: 2px 2px white;
    }
    .filecontainer{
      z-index: -2;
      transform-style: preserve-3d;
      position: absolute;
      left: 50%;
      transform-origin: 50% 0;
      transition: transform 0.4s;
      transform: translate(-50%, 0%)  perspective(2000px) translateY(60vh) rotateX(80deg) translateY(calc(var(--posY)*-300px));
      display:grid;
      grid-template-columns: auto auto auto auto;
      gap: 200px;
      background-image: url("/assets/images/glass.png"), linear-gradient(green, yellow, orange, red, purple, blue);
      background-size: 100% 100%;
      height: <?php echo count($dir) * 300 / 4 + 100;?>px;

      .file:has(a:focus){
          div{
            background-image: radial-gradient(gray, white);
            transform-style: preserve-3d;
            div{
              background-image: none;
              animation: float 2s infinite;
            }
          }
          a{
            --focused: translateY(-20px) rotateX(5deg);
            --end: var(--base) var(--focused);
          }
      }
    }
    .file {
      --cDepth: 40px;
      div{
        background-image: radial-gradient(black, white);
        transform-style: preserve-3d;
        div{
          background-image: none;
        }
      }
      a{
        --base: translateY(-50px) rotateX(-90deg);
        --end: var(--base);
        transform: var(--end); 
        transform-origin: 0 100%;
        display:block;
        width: 100px;
        height: 120px;
        text-align:center;
        transition: transform 0.5s;
        p{
            background-color: #fff7;
            display: block;
            margin: 0;
        }
      }
      img{
        height: 90px;
        width: 90px;
      }
      .htmlPreview{
        height: 900px;
        width: 900px;
        position: absolute;
        transform: scale(0.1);
        transform-origin: 0 0;
        display: block;
        pointer-events: none;
      }
    }
    input{
      display: none;
    }
    .arrow{
      display: none;
      position: absolute;
      right: 10px;
      label{
        display: block;
        width: 80px;
        height: 80px;
        background-image: url("/assets/images/icons/arrow.png");
        background-size: 100% 100%;
        filter: opacity(0.6);
      }
      :hover{
        filter: opacity(1.0);
        cursor: pointer;
      }
      .down{
        transform: rotate(-90deg);
      }
      .up{
        transform: rotate(90deg);
      }
    }
  <?php
    for ($i= 0; $i <= count($dir); $i+=4){
      echo "
      body:has(.row" . floor($i/4) .":focus){
        --posY: " . floor($i/4) . " !important;
      }
      body:has(input:checked#go" . floor($i/4) ."){
        --posY: " . floor($i/4) . ";
      }
      body:has(input:checked#go" . floor($i/4) .") .row" . floor($i/4) . "{
        display: block;
      }
      ";
    }
    ?>
  
  @keyframes float{
    0%{transform:  translateZ(0px)}
    50%{transform:  translateZ(4px)}
    100%{transform:  translateZ(0px)}
  }
  </style>
</head>
<body>
  <h1>
      FILE NAV OF <?php echo getcwd() ?>:
  </h1>
  <?php
    $dir = scandir(".");
    for ($i= 0; $i <= count($dir); $i++){
    echo "
    ";
    }
    for ($i= 0; $i <= count($dir)/4; $i++){
    if ($i == 0){
      ?>
      <input id="go<?php echo $i; ?>" type="radio" name="go" checked>
      <div class="row<?php echo $i; ?> arrow">
        <label class="up" for="go<?php echo $i-1; ?>"></label>
        <label class="down" for="go<?php echo $i+1; ?>"></label>
      </div>
      <?php
    }
    else{
      ?>
      <input id="go<?php echo $i; ?>" type="radio" name="go">
      <div class="row<?php echo $i; ?> arrow">
        <label class="up" for="go<?php echo $i-1; ?>"></label>
        <label class="down" for="go<?php echo $i+1; ?>"></label>
      </div>
      <?php
    }
    }
  ?>
  <div class="filecontainer">
  <?php
    for ($i= 0; $i <= count($dir); $i++){
      if (str_ends_with($dir[$i], "png") || str_ends_with($dir[$i], "jpeg") || str_ends_with($dir[$i], "jpg") || str_ends_with($dir[$i], "gif") || str_ends_with($dir[$i], "webp")){
        $imgPath = "./" . $dir[$i];
      }
      else if ($dir[$i] == ".."){
        $imgPath = "/assets/images/icons/arrow-spin.png";
      }
      else if ($dir[$i] == "."){
        $imgPath = "/assets/images/reload.png";
      }
      else if (is_dir($dir[$i])){
        $imgPath = "/assets/images/folder.png";
      }
      else{
        $imgPath = "/assets/images/file.png";
      }
        $inside = "<img src=\"" . $imgPath . "\">";
        echo "
        <div class=\"cubed file file" . $i .  " \">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div> <div><a class=\"row" . floor($i/4) . "\" href=\"" . $dir[$i] . "/\" > <p>"  . $dir[$i] . "</p>" . $inside . "</a></div></div>
          <div></div>
        </div>
        ";
    }
    ?>
  </div>
</body>
</html>
