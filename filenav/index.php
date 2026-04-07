<!DOCTYPE html>
<html>
<head>
  <!-- <meta http-equiv="refresh" content="5"> -->
  <link rel="stylesheet" href="../styles/ThreeDStyle.css">
  <style>
    body{
      --posY: 0;
      overflow: hidden;
    }
    .filecontainer{
      z-index: -2;
      transform-style: preserve-3d;
      transform-origin: 50% 0;
      transition: transform 1s;
      transform: perspective(80cm)  translateY(60%) rotateX(80deg) translateY(calc(var(--posY)*-71px)) translateX(5%) ;
      display:grid;
      grid-template-columns: auto auto auto auto;
      gap: 200px;
      background-image: linear-gradient(black, grey);
      height: 100vh;

      .file:has(a:focus){
          div{
            background-image: radial-gradient(red, white);
            transform-style: preserve-3d;
          }
      }
    }
    .file {
      --cDepth: 40px;
      div{
        background-image: radial-gradient(black, white);
        transform-style: preserve-3d;
      }
      a{
        transform: rotateX(-90deg);
        transform-origin: 0 100%;
        display:block;
        width: 100px;
        height: 20px;
        text-align:center;
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
    echo "
    <div class=\"cubed file file" . $i .  " \">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div> <a class=\"row" . floor($i/4) . "\" href=\"" . $dir[$i] . "\" >" . $dir[$i] . "</a></div>
      <div></div>
    </div>
    ";
    }
    ?>
  </div>
</body>
</html>
