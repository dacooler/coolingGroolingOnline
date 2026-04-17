<!DOCTYPE html> <html>

<head>
  <meta charset="UTF-8">
  <title>Beads TM</title>
  <link rel="stylesheet" href="beadstyle.css">

</head>

<script>
  const colors = ["#ECE9E3", "#202020", "#7A5C95", "#433264", "#0F9DC8", "#D80F19", "#62615E", "#154171", "#10ACB5", "#E7B310", "#868583", "#8A5534", "#EE3710", "#743C2E", "#C13F18", "#E49457", "#105832", "#DE448C", "#209F49", "#E2C58B"];
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
      $colors = ["#ECE9E3", "#202020", "#7A5C95", "#433264", "#0F9DC8", "#D80F19", "#62615E", "#154171", "#10ACB5", "#E7B310", "#868583", "#8A5534", "#EE3710", "#743C2E", "#C13F18", "#E49457", "#105832", "#DE448C", "#209F49", "#E2C58B"];
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
