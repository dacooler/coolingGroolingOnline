/*front*/
.octed{
    background-size: 100% 100%;
    height:var(--cHeight) !important;
    width: var(--cWidth) !important;
    background-position: top left;
    transform-style: preserve-3d;
    /*(in)SANE DEFAULTS*/
    --cWidth: 100px;
    --cHeight: 100px;
    --cDepth: 100px;
    --img: none;
    --color: #ffffff;
    --flipY: 0deg;
    /*
    DEBUG
    */
    /*
    position: absolute;
    top: 50%;
    left: 50%;
    transform: perspective(100cm) rotate3D(1, 0, 1, 45deg);
    animation-name: debug;
    animation-iteration-count: infinite;
    animation-duration: 4s;
    animation-timing-function: linear;
    */
}


<?php
for ($side = 1; $side <= 8; $side++) {
?>
.octed > div:nth-child(<?php echo $side; ?>){
    position: absolute;
    top: 50%;
    left: 50%;
    width: calc(var(--cWidth) * (sqrt(2) - 1) + 1px);
    height: var(--cDepth);
    transform: translate(-50%, -50%) rotate(<?php echo $side * 45; ?>deg) rotateX(90deg) translateZ(calc(var(--cWidth) / 2)) translateY(50%) rotateZ(180deg);
    transform-origin: 50% 50% 0;
}
<?php
}
?>

<?php
for ($side = 1; $side <= 2; $side++) {
?>
.octed > div:nth-child(<?php echo 8 + $side; ?>){
    position: absolute;
    top: 0;
    left: 0;
    width: var(--cWidth);
    height: var(--cWidth);
    <?php if($side == 1) { echo "transform: translateZ(var(--cDepth));"; } ?>
    transform-origin: 50% 50% 0;
    mask: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"><polygon points="29.28932188134524,0 70.71067811865476,0 100,29.28932188134524 100,70.71067811865476 70.71067811865476,100 29.28932188134524,100 0,70.71067811865476 0,29.28932188134524" /></svg>') 100% 100%;
}
<?php
}
?>
@keyframes debug {
        from {transform: perspective(100cm) rotate3D(1, 1, 1, 0deg);}
        to {transform: perspective(100cm) rotate3D(1, 1, 1, 360deg);}
}

.octed > div{
        transform-style: preserve-3d;
        background-image: var(--img);
        background-color: var(--color);
        transform: perspective(100cm);
        background-size: 100% 100%;
}
