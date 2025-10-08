<!DOCTYPE html> <html>

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
  <link rel="stylesheet" href="./assets/cubestyle.css">
  <link rel="stylesheet" href="./assets/cursedStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap" rel="stylesheet">
</head>

<body id="grad1">
  <div>
    <div class="left">
      <div class="visitors">
        <img src="./assets/images/visitors.png">
        <p>
          <?php include("counter.php"); echo IncrementCounter(); ?>
        </p>
      </div>
      <div class="list">
        <p>GAMEES</p>
        <a href="files/coolGame.jar">COOLGAME</a>
        <a href="https://harald-thorsson.itch.io/robo-os">ROBO-OS</a>
        <a href="https://harald-thorsson.itch.io/rat-paul-elite-boxing">Rat Paul: Elite Boxing</a>
        <a href="https://vancia100.github.io/tripple-trouble/">Tripple Trouble</a>
        <p>COOL WEBSITES</p>
        <a href="http://thorsson.tplinkdns.com:55744/index.html">THORSSON tplinkdns</a>
        <button href="http://coolinggrooling.online" target="iframe_a" onclick="myFunction()">
          THIS SITE!!!! O:
        </button>
        <p>!!!!!!</p>
        <a href="experiments/3dmenu.html"> Navigation</a>
        <img src="./assets/images/DANC.gif" class="mitten">
      </div>
    </div>
    <div class="middle" id="this">
      <div id="grad">
        <div style="display:flex">
          <img class="title" src="./assets/images/cooltext.gif">
          <img class="title" src="./assets/images/number2.gif">
        </div>
        <img class="cool" src="./assets/images/KOLBILD.jpg" width="300" style="display:block;margin:auto">
                <div class="cube">
                        <div id="c1"><img src="../assets/images/CERTIFIKAT SVARTVIT.jpg"></div>
                        <div id="c2"><img src="../assets/images/wallpaper.jpeg"></div>
                        <div id="c3"><img src="../assets/images/CERTIFIKAT SVARTVIT.jpg"></div>
                        <div id="c4"><img src="../assets/images/wallpaper.jpeg"></div>
                        <div id="c5"><img src="../assets/images/wallpaper.jpeg"></div>
                        <div id="c6"><img src="../assets/images/wallpaper.jpeg"></div>
                </div>
        <img src="./assets/images/quotes.png">
        <div class="wood">
          <div class="wall">
            <div class="speechspeech">
              <img class="cool" src="./assets/images/CERTIFIKAT SVARTVIT.jpg">
              <div class="speechContainer">
                <img src="./assets/images/scroll-top.png">
                <div class="speech">
                  <p><?php include("quotes.php"); echo getQuote(); ?></p>
                </div>
                <img src="./assets/images/scroll-bottom.png">
              </div>
            </div>
          </div>
        </div>
        <div style="background-color:pink">
          <h1 style="color:blue;text-align:center;">
            "JUST KEEP ON WORKING UNTIL YOU HAVE REACHED YOUR GOAL. BUT WHEN YOU REACH YOUR GOAL DON'T STOP THERE UNLESS
            YOU ARE HAPPY AND YOU DON'T WANT TO REACH FURTHER IN YOUR CAREER" - Mårten "Marhinnio" Pettersson Belusa
          </h1>
        </div>
        <img src="./assets/images/ANI.gif" class="mitten">
        <iframe frameborder="0"
          src="https://itch.io/embed/3295620?border_width=5&amp;bg_color=1c7e84&amp;fg_color=ffffff&amp;link_color=0cfffb&amp;border_color=bebebe"
          width="560" height="175"><a href="https://harald-thorsson.itch.io/robo-os">ROBO-OS by Harald
            Thorsson</a></iframe>
      </div>
    </div>
    <div class="footer">
      <a href="http://cooltext.com" target="_top"><img src="https://cooltext.com/images/ct_button.gif" width="88"
          height="31" alt="Cool Text: Logo and Graphics Generator" /></a>
      <img src="assets/images/thorssontplinkdns.gif" width="88" height="31">
      <img src="assets/images/coolingGrooling.gif" width="88" height="31">
    </div>
  </div>
</body>

</html>
