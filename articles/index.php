<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8">
        <title>COOLING GROOLING</title>
        <script src="./assets/script.js" type="module"></script>
        <script src="./assets/cursor.js"></script>
        <script>
                function myFunction() {
                        document.getElementById("this").innerHTML = `<iframe src="http://coolinggrooling.online" style="width:100%;height:1000px"></iframe>`;
                }

        </script>
        <style>
        </style>
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
        for($i = 0; $i< 3; $i++){
  ?>
        ||<a href="./arts/sanningen/."> Sanningen bakom viagraparken </a>|| <a href="./arts/soltorkade-tomater/."> WiFi och konsumtion av soltorkade tomater </a>||<a href="./arts/akademiska-hus-kth/."> Sanningen bakom Akademiska Hus och KTH </a>||<a href="./arts/skaparen-av-haskell-och-staketet/."> Skaparen av Haskell och Staketet avslöjas! </a>
<?php
        }
  ?>
        </div>
      </div>
        <div class="main">
                <img src="../assets/images/articles.png">
                <br>
                <a href="./arts/sanningen/."> Sanningen bakom viagraparken </a>
                <a href="./arts/soltorkade-tomater/."> WiFi och konsumtion av soltorkade tomater </a>
                <a href="./arts/akademiska-hus-kth/."> Sanningen bakom Akademiska Hus och KTH </a>
                <a href="./arts/skaparen-av-haskell-och-staketet/."> Skaparen av Haskell och Staketet avslöjas! </a>
        </div>
</body>
<?php
  include("bottom.php")
?>
