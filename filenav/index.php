<!DOCTYPE html>
<html>
<head>
  <!-- <meta http-equiv="refresh" content="5"> -->
  <link rel="stylesheet" href="/styles/ThreeDStyle.css">
  <style>
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
      transform: translate(-50%, 0%)  perspective(2000px) translateY(60vh) rotateX(90deg) translateY(calc(var(--posY)*-80px));
      display:grid;
      grid-template-columns: auto auto auto auto;
      gap: 200px;
      background-image: linear-gradient(green, yellow, orange, red, purple, blue);
      height: 800vh;

      .file:has(a:focus){
          div{
            background-image: radial-gradient(red, white);
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
        height: 110px;
        text-align:center;
        transition: transform 0.5s;
      }
      img{
        height: 90px;
        width: 90px;
      }
    }
  <?php
    $dir = scandir(".");
    for ($i= 0; $i <= count($dir); $i+=4){
      echo "
      body:has(.row" . floor($i/4) .":focus){
        --posY: " . $i . ";
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
  ?>
  <div class="filecontainer">
  <?php
    $dir = scandir(".");
    for ($i= 0; $i <= count($dir); $i++){
      if (str_ends_with($dir[$i], "png") || str_ends_with($dir[$i], "jpeg") || str_ends_with($dir[$i], "jpg") || str_ends_with($dir[$i], "gif") || str_ends_with($dir[$i], "webp")){
        echo "
        <div class=\"cubed file file" . $i .  " \">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div> <div><a class=\"row" . floor($i/4) . "\" href=\"" . $dir[$i] . "\" >"  . $dir[$i] . "<img src=\"./" . $dir[$i] . "\"> </a></div></div>
          <div></div>
        </div>
        ";
      }
      else if ($dir[$i] == ".."){
        echo "
          <div class=\"cubed file file" . $i .  " \">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div> <div><a class=\"row" . floor($i/4) . "\" href=\"" . $dir[$i] . "/\" >"  . $dir[$i] . "<img src=\"/assets/images/icons/arrow-spin.png\"> </a></div></div>
            <div></div>
          </div>
          ";
      }
      else if (is_dir($dir[$i])){
        echo "
          <div class=\"cubed file file" . $i .  " \">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div> <div><a class=\"row" . floor($i/4) . "\" href=\"" . $dir[$i] . "/\" >"  . $dir[$i] . "<img src=\"/assets/images/folder.png\"> </a></div></div>
            <div></div>
          </div>
          ";
      }
      else{
    echo "
      <div class=\"cubed file file" . $i .  " \">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div> <div><a class=\"row" . floor($i/4) . "\" href=\"" . $dir[$i] . "\" >"  . $dir[$i] . "<img src=\"/assets/images/file.png\"> </a></div></div>
        <div></div>
      </div>
      ";
      }
    }
    ?>
  </div>
</body>
</html>
