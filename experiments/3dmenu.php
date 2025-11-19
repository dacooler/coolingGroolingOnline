<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8">
        <title>_PageTitle_</title>
        <link rel="stylesheet" href="menuStyle.css">
        <link rel="stylesheet" href="gramStyle.css">
        <link rel="stylesheet" href="compStyle.css">
        <link rel="stylesheet" href="ThreeDStyle.css">
        <link rel="stylesheet" href="../assets/cubestyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <style>
                :root {
                        --perspective: 100cm;
                        --timeset:<?php 
                                date_default_timezone_set('Europe/Stockholm');
                        echo date('G.i'); 
                        ?>;

                        --times: calc(var(--timeset)/24);
                }

                .cube {
                        position: absolute !important;
                        top: -50px !important;
                }
        </style>
</head>

<body>
        <div>
                <input type="radio" id="menu1" name="dm">
                <input type="radio" id="menu2" name="dm">
                <input type="radio" id="menu3" name="dm">
                <input type="radio" id="menu4" name="dm">
                <input type="radio" id="menu5" name="dm">
                <div class="sky">
                <div></div>
                <div></div>
                </div>
                <div class="dMenu">
                        <label for="menu1">
                                <div><a>No Javascript</a></div>
                                <div></div>
                        </label>
                        <label for="menu2">
                                <div><a href="../articles/">Articles</a></div>
                                <div></div>
                        </label>
                        <label for="menu3">
                                <div><a href="../">Homepage</a></div>
                                <div></div>
                        </label>
                        <label for="menu4">
                                <div><a href="../music/">music</a></div>
                                <div></div>
                        </label>
                        <label for="menu5">
                                <div></div>
                                <div></div>
                        </label>
                        <div class="ground"> </div>
                        <img src="../assets/images/future.png" class="future"></img>
                        <a href="../music/" class="gramCont">
                                <div class="grammer">
                                        <div class="F"> </div>
                                        <div class="B"> </div>
                                        <div class="R">
                                                <img src="../assets/images/crank.png" class="crank">
                                        </div>
                                        <div class="L"> </div>
                                        <div class="BK"> </div>
                                        <div class="T">
                                                <img src="../assets/images/cone.png" class="cone">
                                                <img src="../assets/images/record.png" class="record">
                                        </div>
                                </div>
                        </a>
                        <a href="./cube.html"
                                style="transform-style:preserve-3d;transform:perspective(var(--perspective));display:block">
                                <div class="cube">
                                        <div id="c1"><img src="../assets/images/CERTIFIKAT SVARTVIT.jpg"></div>
                                        <div id="c2"><img src="../assets/images/wallpaper.jpeg"></div>
                                        <div id="c3"><img src="../assets/images/CERTIFIKAT SVARTVIT.jpg"></div>
                                        <div id="c4"><img src="../assets/images/wallpaper.jpeg"></div>
                                        <div id="c5"><img src="../assets/images/wallpaper.jpeg"></div>
                                        <div id="c6"><img src="../assets/images/wallpaper.jpeg"></div>
                                </div>
                        </a>
                        <div class="floater">
                                <a href="../articles/" class="article">
                                        <div>
                                                <img src="../assets/images/cgnews.png">
                                                <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam massa arcu, dictum ut enim in, tristique hendrerit diam. Vestibulum fringilla orci sit amet felis dignissim tristique. Mauris enim ante, porta quis egestas vitae, consequat quis risus. Curabitur auctor urna id sapien lobortis, tempus convallis velit ultricies. Proin ac aliquet dui. Maecenas non maximus eros. Duis interdum at neque at ultrices. Proin efficitur vestibulum luctus. Morbi nunc nulla, finibus in hendrerit sed, maximus in est. In non turpis augue. Vivamus id nulla felis.
                                                </p>

                                                <p>
                                                        In hac habitasse platea dictumst. Proin non convallis
                                                        erat.
                                                        Nulla
                                                        fermentum mi
                                                        et justo vulputate tristique. Vestibulum pellentesque
                                                        fringilla
                                                        ipsum, a
                                                        rhoncus
                                                        est ultricies et. Proin aliquam imperdiet orci. Praesent
                                                        vel
                                                        libero ut
                                                        quam
                                                        rhoncus hendrerit. Nulla nec eros eu dolor tempor
                                                        vulputate.
                                                        Duis quam
                                                        magna,
                                                        lacinia in nibh sit amet, sodales porta orci. Nam
                                                        molestie
                                                        volutpat
                                                        sagittis.
                                                        Quisque feugiat lectus nunc, sed tincidunt ante aliquet
                                                        nec.
                                                        Nullam
                                                        volutpat dui
                                                        vitae enim ullamcorper, et pulvinar purus vulputate.
                                                        Vivamus
                                                        porta dui a
                                                        tortor
                                                        mollis, vitae commodo augue semper. Nam sed nunc sed
                                                        mauris
                                                        placerat
                                                        dignissim
                                                        eu eu lacus. Cras viverra tincidunt dapibus.
                                                </p>
                                        </div>
                                </a>
                        </div>
                        <div class="compTainer">
                                <label for="menu1" class="right"> <p> > </p> </label>
                                <label for="menu4" class="left"> <p> < </p> </label>
                                <div class="comp">
                                        <!-- left -->
                                        <div>
                                                <div>
                                                </div>
                                        </div>
                                        <!-- right -->
                                        <div>
                                                <div>
                                                </div>
                                        </div>
                                        <!-- front -->
                                        <div>
                                                <div class="monitor">
                                                        <input id="grulComp" type="checkbox">
                                                        <div class="backscreen"></div>
                                                        <div class="screen">
                                                                <iframe src="../">

                                                                </iframe>
                                                        </div>
                                                        <p> GrulTECH </p>
                                                        <label for="grulComp">
                                                                ⏻
                                                        </label>
                                                </div>
                                        </div>
                                        <!-- back -->
                                        <div></div>
                                        <!-- bottom -->
                                        <div>
                                                <div>
                                                </div>
                                                <div class="cubed"
                                                        style="--cHeight:60px;--cWidth:60px;--cDepth:10px;--color:#d5d4c0;">
                                                        <!-- bottom -->
                                                        <div>
                                                        </div>
                                                        <!-- front -->
                                                        <div>
                                                        </div>
                                                        <!-- left -->
                                                        <div>
                                                        </div>
                                                        <!-- right-->
                                                        <div>
                                                        </div>
                                                        <!-- back-->
                                                        <div>
                                                                <div class="cubed"
                                                                        style="--cHeight:80px;--cWidth:80px;--cDepth:10px;--img:radial-gradient(gray, lightgray);">
                                                                        <!-- bottom -->
                                                                        <div>
                                                                        </div>
                                                                        <!-- front -->
                                                                        <div>
                                                                        </div>
                                                                        <!-- left -->
                                                                        <div>
                                                                        </div>
                                                                        <!-- right-->
                                                                        <div>
                                                                        </div>
                                                                        <!-- back-->
                                                                        <div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <!-- top -->
                                        <div>
                                                <div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
</body>
