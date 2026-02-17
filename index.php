<!DOCTYPE html> <html>

<head>
  <meta charset="UTF-8">
  <title>COOLING GROOLING</title>
  <script>
    function myFunction() {
      document.getElementById("this").innerHTML = `<iframe src="http://coolinggrooling.online" style="width:100%;height:1000px"></iframe>`;
    }

  </script>
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
        <a href="./navigation/"> Navigation</a>
        <a href="./adventure2/"> Adventure Demo <img class="new" src="assets/images/NEW.png">  </a>
        <img src="./assets/images/DANC.gif" class="mitten">
      </div>
    </div>
    <div class="middle" id="this">
      <div id="grad">
        <div style="display:flex">
          <img class="title" src="./assets/images/cooltext.gif">
          <img class="title" src="./assets/images/number2.gif">
        </div>
        <div class="GoNavigate">
          <a href="navigation/"> GO NAVIGATE!!! </a>
          <div class="arrow a1"></div>
          <div class="arrow a2"></div>
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
          <iframe src="./graph/" class="graph"></iframe>
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
  <div class="minilinks">

    <a href="https://github.com/dacooler/coolingGroolingOnline"> Github </a>
  </div>
  </div>
</body>

</html>
