<html>
  <head>
    <link rel="stylesheet" href="beadstyle.css">
    <script>
      let fileContent = `<?php
      if (($handle = fopen("logs/" . date("W-Y") . ".log", "r")) !== false) {
        echo fread($handle, 100000);
      }
      ?>`
      let steps = fileContent.slice(0, -1).split("\n");
      let currentStep = 0;
      const colors = ["#ECE9E3", "#202020", "#7A5C95", "#433264", "#0F9DC8", "#D80F19", "#62615E", "#154171", "#10ACB5", "#E7B310", "#868583", "#8A5534", "#EE3710", "#743C2E", "#C13F18", "#E49457", "#105832", "#DE448C", "#209F49", "#E2C58B"];

      function animateOneStep() {
        if (currentStep >= steps.length) {
          clearBeads();
          currentStep = 0;
          return;
        }
        let kids = document.getElementById("beads-base").children;
        let items = steps[currentStep % steps.length].split(" "); 
        let x = parseInt(items[0]);
        let y = parseInt(items[1]);
        let color = parseInt(items[2]);
        let i = y * 29 + x;
        kids[i].style.backgroundColor = colors[color];
        currentStep++;
      }

      function clearBeads() {
        let kids = document.getElementById("beads-base").children;
        for (let kid of kids) {
          kid.style.backgroundColor = "#ffffff";
        }
      }

      setInterval(animateOneStep, 100);
    </script>
  </head>
  <body>
    <div class="main">
      <div class="goback">
      <a href=".">Go back</a>
      </div>
      <div class="holder">
        <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 30; $i++) { echo("16px "); } ?>" id="beads-base" class="beads-base">
          <?php
            for ($y = 0; $y < 30; $y++) {
              for ($x = 0; $x < 30; $x++) {
                ?>
                <button data-x=<?php echo $x ?> data-y=<?php echo $y ?> class="bead"</button>
                <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>