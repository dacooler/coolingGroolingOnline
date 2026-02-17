<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>_PageTitle_</title>
    <link rel="stylesheet" href="menuStyle.css">
    <link rel="stylesheet" href="gramStyle.css">
    <link rel="stylesheet" href="gameStyle.css">
    <link rel="stylesheet" href="compStyle.css">
    <link rel="stylesheet" href="../styles/ThreeDStyle.css">
    <link rel="stylesheet" href="../assets/cubestyle.css">
    <style>
    :root {
      --perspective: 100cm;
      --timeset:<?php 
        date_default_timezone_set('Europe/Stockholm');
      echo date('G.i'); 
      ?>;

      --times: calc(var(--timeset)/24);
    }

    .cube {
      position: absolute !important;
      top: -50px !important;
    }
    </style>
  </head>

  <body>
    <div>
      <input type="radio" id="menu1" name="dm">
      <input type="radio" id="menu2" name="dm">
      <input type="radio" id="menu3" name="dm">
      <input type="radio" id="menu4" name="dm">
      <input type="radio" id="menu5" name="dm">
      <div class="sky">
        <div class="clouds"></div>
        <div class="bigstars"></div>
        <div class="smallstars"></div>
        <div class="blinkstars1"></div>
        <div class="blinkstars2"></div>
        <div class="blinkstars3"></div>
      </div>
      <div class="dMenu">
        <label for="menu1">
          <div><a href="../gaming/">Gaming</a></div>
          <div></div>
        </label>
        <label for="menu2">
          <div><a href="../articles/">Articles</a></div>
          <div></div>
        </label>
        <label for="menu3">
          <div><a href="../">Homepage</a></div>
          <div></div>
        </label>
        <label for="menu4">
          <div><a href="../music/">music</a></div>
          <div></div>
        </label>
        <label for="menu5">
          <div></div>
          <div></div>
        </label>
        <div class="ground"> </div>
        <img src="../assets/images/future.png" class="future"></img>
<?php
        require("src/music.php");
?>
<?php
        require("src/cube.php");
?>
<?php
        require("src/gaming.php");
?>
<?php
        require("src/articles.php");
?>
<?php
        require("src/computer.php");
?>
      </div>
  </body>
