<!DOCTYPE html> <html>

<head>
  <meta charset="UTF-8">
  <title>Beads TM</title>
  <link rel="stylesheet" href="beadstyle.css">

</head>

<script>
  const colors = ["#ECE9E3", "#353535", "#a287b9", "#7f548e", "#6db4c9", "#de262f", "#93928f", "#23578e", "#71d4b0", "#efd034", "#c0bfbe", "#d59871", "#ff7b17", "#a76555", "#e8734f", "#f4c29b", "#147240", "#f15ca1", "#8cd85c", "#fae5bc"];
  let selectedColorIndex = 0;
  let selectedColor = colors[selectedColorIndex];
  let flipped = false;

  function setColorOn(element) {
    element.style.backgroundColor = selectedColor;
    //fetch("/beads/paint.php/?x=" + element.dataset.x + "&y=" + element.dataset.y + "&color=" + selectedColorIndex);
    let x;
    if (flipped) {
      x = 29 - element.dataset.x;
    } else {
      x = element.dataset.x;
    }
    fetch("paint.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        x: x,
        y: element.dataset.y,
        color: selectedColorIndex,
      })
    });
  }

  function selectColor(colorIndex) {
    selectedColorIndex = colorIndex
    selectedColor = colors[colorIndex];
    document.getElementById("selected").style.backgroundColor = selectedColor;
    document.getElementById("beads-base").style.backgroundColor = selectedColor;
  }

  function flipTheBeads() {
    flipped = !flipped;
    setUpBeads();
  }

  async function setUpBeads() {
    let url = "get-beads.php"
    let response = await fetch(url)
    let beads = await response.text();

    let beadColors = beads.split("\n").map((row) => row.split(",").map((elem) => colors[parseInt(elem)]));

    let kids = document.getElementById("beads-base").children;
    let kids2 = document.getElementById("beads-back").children;
    for (let y = 0; y < 30; y++) {
      for (let x = 0; x < 30; x++) {
        let i;
        if (flipped) {
          i = y * 30 + 29 - x;
        }
        else {
          i = y * 30 + x;
        }
        kids[i].style.backgroundColor = beadColors[y][x];
        kids2[i].style.backgroundColor = beadColors[y][x];
      }
    }
  }

  setInterval(setUpBeads, 1000);
</script>

<body onload="setUpBeads()">
  <div class="main">
      <div class="goback">
        <a href="../">
        Go Back
        </a>
        <br>
        <a href="./snapshots/">
          Snapshots
        </a>
        <br>
        <a href="animated.php">
          Animation
        </a>
      </div>
  <div class="holder">
  <div class="backgr">
    <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 30; $i++) { echo("16px "); } ?>" id="beads-base" class="beads-base">
      <?php
        for ($y = 0; $y < 30; $y++) {
          for ($x = 0; $x < 30; $x++) {
            ?>
            <button data-x="<?php echo $x ?>" data-y="<?php echo $y ?>" class="bead" onclick="setColorOn(this)" ></button>
            <?php
          }
        }
      ?>
    </div>
    <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 30; $i++) { echo("16px "); } ?>" id="beads-back" class="beads-back">
      <?php
        for ($y = 0; $y < 30; $y++) {
          for ($x = 0; $x < 30; $x++) {
            ?>
            <div class="bead" onclick="setColorOn(this)" ></div>
            <?php
          }
        }
      ?>
    </div>
    </div>
    </div>
    <div class="selector">
      <div id = "selected">
        <h3 > Select color: </h3>
      </div>
      <div class="selections">
      <?php
      $colors = ["#ECE9E3", "#353535", "#a287b9", "#7f548e", "#6db4c9", "#de262f", "#93928f", "#23578e", "#71d4b0", "#efd034", "#c0bfbe", "#d59871", "#ff7b17", "#a76555", "#e8734f", "#f4c29b", "#147240", "#f15ca1", "#8cd85c", "#fae5bc"];
      for ($colorIndex = 0; $colorIndex < count($colors); $colorIndex++) {
        ?>
        <button style="background-color: <?php echo $colors[$colorIndex]; ?>;" onclick="selectColor('<?php echo $colorIndex; ?>')"></button>
        <?php
      }
      ?>
      </div>
    </div>
    <button onclick="flipTheBeads();">
      FLIP THE BEADS!
    </button>
  </div>
</body>

</html>
