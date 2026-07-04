<html>
  <head>
    <link rel="stylesheet" href="beadstyle.css">
    <script>
      let page = 0;
      let fileContent = [<?php
      $files = array_values(array_diff(scandir("./logs"), array('.', '..', "index.php", ".gitkeep", ".gitignore")));
      foreach($files as $file){
        echo "`";
        if (($handle = fopen("./logs/" . $file, "r")) !== false) {
          if (flock($handle, LOCK_EX)){
            echo fread($handle, filesize("./logs/".$file));
          }
        }
        echo "`,";
      }
      ?>
      ];
      let steps = fileContent[page].slice(0, -1).split("\n");
      function increase(){
        page = (page + 1)%fileContent.length;
        steps = fileContent[page].slice(0, -1).split("\n");
        input = document.getElementById("timeline");
        speed = document.getElementById("speed");
        input.max = steps.length;
        changeSpeed(speed.value)
        animateTo(input.value);
        clearBeads()
      }
      function decrease(){
        page = (page - 1)%fileContent.length;
        steps = fileContent[page].slice(0, -1).split("\n");
        input = document.getElementById("timeline");
        speed = document.getElementById("speed");
        input.max = steps.length;
        changeSpeed(speed.value)
        animateTo(input.value);
        clearBeads()
      }
      let currentStep = 0;
      const colors = ["#ECE9E3", "#353535", "#a287b9", "#7f548e", "#6db4c9", "#de262f", "#93928f", "#23578e", "#71d4b0", "#efd034", "#c0bfbe", "#d59871", "#ff7b17", "#a76555", "#e8734f", "#f4c29b", "#147240", "#f15ca1", "#8cd85c", "#fae5bc"];

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
        let kids2 = document.getElementById("beads-back").children;
        let items = steps[currentStep % steps.length].split(" "); 
        let x = parseInt(items[0]);
        let y = parseInt(items[1]);
        let color = parseInt(items[2]);
        let i = y * 30 + x;
        kids[i].style.backgroundColor = colors[color];
        kids2[i].style.backgroundColor = colors[color];
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
        let kids2 = document.getElementById("beads-back").children;
        for (let kid of kids2) {
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
      <div class="left">
        <button class="back" onclick="decrease()"><</button>
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
            <div style="display: grid; grid-template-columns: <?php for ($i = 0; $i < 30; $i++) { echo("16px "); } ?>" id="beads-back" class="beads-back">
              <?php
                for ($y = 0; $y < 30; $y++) {
                  for ($x = 0; $x < 30; $x++) {
                    ?>
                    <div class="bead"></div>
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
        <div class="right">
          <button class="forward" onclick="increase()">></button>
        </div>
    </div>
  </body>
</html>
