<!DOCTYPE html> <html>

<head>
  <meta charset="UTF-8">
  <title>Beads TM</title>
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
  }

  async function setUpBeads() {
    let url = "/beads/beads.csv"
    let response = await fetch(url)
    let beads = await response.text();

    let beadColors = beads.split(",").map((elem) => colors[parseInt(elem)]);

    let kids = document.getElementById("beads-base").children;
    for (let y = 0; y < 29; y++) {
      for (let x = 0; x < 29; x++) {
        let i = y * 29 + x;
        kids[i].style.backgroundColor = beadColors[i];
      }
    }
  }

  setInterval(setUpBeads, 1000);
</script>

<body onload="setUpBeads()">
  <div style="display: flex; flex-direction: row; align-items: center;">
    <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 29; $i++) { echo("16px "); } ?>" id="beads-base">
      <?php
        for ($y = 0; $y < 29; $y++) {
          for ($x = 0; $x < 29; $x++) {
            ?>
            <button data-x=<?php echo $x ?> data-y=<?php echo $y ?> style="background-color: coral; width: 16px; height: 16px;" onclick="setColorOn(this)"</button>
            <?php
          }
        }
      ?>
    </div>
    <div style="width: 16px;"></div>
    <div style="height: 16px;">
      <?php
      $colors = ["#ffffff", "#000000", "#ff0000", "#ff8800", "#ffff00", "#00ff00", "#0088ff", "#bb22ff"];
      for ($colorIndex = 0; $colorIndex < 8; $colorIndex++) {
        ?>
        <button style="background-color: <?php echo $colors[$colorIndex]; ?>; height: 16px" onclick="selectColor('<?php echo $colorIndex; ?>')"></button>
        <?php
      }
      ?>
    </div>
  </div>
</body>

</html>