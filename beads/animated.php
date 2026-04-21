<html>
  <head>
    <link rel="stylesheet" href="beadstyle.css">
    <script>
      let fileContent = `<?php
      if (($handle = fopen("logs/" . date("W-Y") . ".log", "r")) !== false) {
        if (flock($handle, LOCK_EX)){
          echo fread($handle, filesize("logs/" . date("W-Y") . ".log", "r"));
        }
      }
      ?>`
      let steps = fileContent.slice(0, -1).split("\n");
      let currentStep = 0;
      const colors = ["#ECE9E3", "#202020", "#7A5C95", "#433264", "#0F9DC8", "#D80F19", "#62615E", "#154171", "#10ACB5", "#E7B310", "#868583", "#8A5534", "#EE3710", "#743C2E", "#C13F18", "#E49457", "#105832", "#DE448C", "#209F49", "#E2C58B"];

      function startSlider(){
        input = document.getElementById("timeline");
        button = document.getElementById("playback");
        speed = document.getElementById("speed");
        input.max = steps.length;
        button.addEventListener("click", (event) => {
          changePlayback(button);
        });
        speed.addEventListener("input", (event) => {
          changeSpeed(event.target.value);
});
        input.addEventListener("input", (event) => {
          animateTo(event.target.value);
});
      }
      function updateTime(){
        animateOneStep();
        input = document.getElementById("timeline");
        input.value = currentStep;

      }
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
        let i = y * 30 + x;
        kids[i].style.backgroundColor = colors[color];
        currentStep++;
      }

      let playing = false;
      let playIntervalId = 0;
      let pSpeed = 10;
      function changeSpeed(speed){
        pSpeed = speed; 
        if (playing){
          clearInterval(playIntervalId);
          playIntervalId = setInterval(updateTime, 1000/speed);
        }
      }

      function changePlayback(button){
        if (!playing){
          playIntervalId = setInterval(updateTime, 100);
          playing = true;
          changeSpeed(pSpeed);
          button.value = "⏸";
        }
        else{
          clearInterval(playIntervalId);
          playing = false;
          button.value = "▶";
        }
      }

      function animateTo(step){
        if(step < currentStep){
          clearBeads();
          currentStep = 0;
          for(let i = step; i >= 0; i--){
            animateOneStep();
          }
        }
        else{
          for(let i = step - currentStep; i >= 0; i--){
            animateOneStep();
          }
        }
      }

      function clearBeads() {
        let kids = document.getElementById("beads-base").children;
        for (let kid of kids) {
          kid.style.backgroundColor = "#ECE9E3";
        }
      }

    </script>
  </head>
  <body onload="startSlider()">
    <div class="main">
      <div class="goback">
      <a href=".">Go back</a>
      </div>
      <div class="playbackMain">
        <div class="holder">
          <div class="backgr">
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
          <div class="goBack">
            <input type="range" step="1" min="0"  id="timeline"></input>
            <div class="options">
              <input type="button" id="playback" value="▶">
              <div class="speedholder">
                <label for="speed">Speed:</label>
                <input type="range" value="10" step="any" min="1" max="1000" id="speed"></input>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
