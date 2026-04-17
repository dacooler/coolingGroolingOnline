<!DOCTYPE html> <html>

<head>
  <meta charset="UTF-8">
  <title>Beads TM</title>
  <link rel="stylesheet" href="beadstyle.css">

</head>

<script>
  const colors = ["#ffffff", "#000000", "#8664a0", "#4c3579", "#07b1cb", "#f41321", "#72716d", "#154889", "#17b1bb", "#e8c008", "#aba7a5", "#a45f40", "#e9660e", "#9b5039", "#d4440f", "#f0a260", "#116333", "#da538e", "#47ac5c", "#dcc38a"];
  let selectedColorIndex = 0;
  let selectedColor = colors[selectedColorIndex];

  function setColorOn(element) {
    element.style.backgroundColor = selectedColor;
    //fetch("/beads/paint.php/?x=" + element.dataset.x + "&y=" + element.dataset.y + "&color=" + selectedColorIndex);
    fetch("paint.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        x: element.dataset.x,
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

  async function setUpBeads() {
    let url = "get-beads.php"
    let response = await fetch(url)
    let beads = await response.text();

    let beadColors = beads.split("\n").map((row) => row.split(",").map((elem) => colors[parseInt(elem)]));

    let kids = document.getElementById("beads-base").children;
    for (let y = 0; y < 30; y++) {
      for (let x = 0; x < 30; x++) {
        let i = y * 30 + x;
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
  <div class="backgr">
    <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 30; $i++) { echo("16px "); } ?>" id="beads-base" class="beads-base">
      <?php
        for ($y = 0; $y < 30; $y++) {
          for ($x = 0; $x < 30; $x++) {
            ?>
            <button data-x=<?php echo $x ?> data-y=<?php echo $y ?> class="bead" onclick="setColorOn(this)"</button>
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
      $colors = ["#ffffff", "#000000", "#8664a0", "#4c3579", "#07b1cb", "#f41321", "#72716d", "#154889", "#17b1bb", "#e8c008", "#aba7a5", "#a45f40", "#e9660e", "#9b5039", "#d4440f", "#f0a260", "#116333", "#da538e", "#47ac5c", "#dcc38a"];
      for ($colorIndex = 0; $colorIndex < count($colors); $colorIndex++) {
        ?>
        <button style="background-color: <?php echo $colors[$colorIndex]; ?>;" onclick="selectColor('<?php echo $colorIndex; ?>')"></button>
        <?php
      }
      ?>
      </div>
    </div>
  </div>
</body>

</html>
