<!DOCTYPE html> <html>

<head>
  <meta charset="UTF-8">
  <title>Beads TM</title>
  <link rel="stylesheet" href="beadstyle.css">

</head>

<script>
  const colors = ["#ffffff", "#000000", "#ff0000", "#ff8800", "#ffff00", "#00ff00", "#0088ff", "#bb22ff"];
  let selectedColorIndex = 0;
  let selectedColor = colors[selectedColorIndex];

  function setColorOn(element) {
    element.style.backgroundColor = selectedColor;
    fetch("/beads/paint.php/?x=" + element.dataset.x + "&y=" + element.dataset.y + "&color=" + selectedColorIndex);
  }

  function selectColor(colorIndex) {
    selectedColorIndex = colorIndex
    selectedColor = colors[colorIndex];
    document.getElementById("selected").style.backgroundColor = selectedColor;
    document.getElementById("beads-base").style.backgroundColor = selectedColor;
  }

  async function setUpBeads() {
    let url = "get-beads.php"
    let response = await fetch(url)
    let beads = await response.text();

    let beadColors = beads.split("\n").map((row) => row.split(",").map((elem) => colors[parseInt(elem)]));

    let kids = document.getElementById("beads-base").children;
    for (let y = 0; y < 29; y++) {
      for (let x = 0; x < 29; x++) {
        let i = y * 29 + x;
        kids[i].style.backgroundColor = beadColors[y][x];
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
      </div>
  <div class="holder">
    <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 29; $i++) { echo("16px "); } ?>" id="beads-base" class="beads-base">
      <?php
        for ($y = 0; $y < 29; $y++) {
          for ($x = 0; $x < 29; $x++) {
            ?>
            <button data-x=<?php echo $x ?> data-y=<?php echo $y ?> class="bead" onclick="setColorOn(this)"</button>
            <?php
          }
        }
      ?>
    </div>
    </div>
    <div class="selector">
      <div id = "selected">
        <h3 > Select color: </h3>
      </div>
      <?php
      $colors = ["#ffffff", "#000000", "#ff0000", "#ff8800", "#ffff00", "#00ff00", "#0088ff", "#bb22ff"];
      for ($colorIndex = 0; $colorIndex < 8; $colorIndex++) {
        ?>
        <button style="background-color: <?php echo $colors[$colorIndex]; ?>;" onclick="selectColor('<?php echo $colorIndex; ?>')"></button>
        <?php
      }
      ?>
    </div>
  </div>
</body>

</html>
