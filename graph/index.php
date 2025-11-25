<!DOCTYPE html>
<html>

<head>
        <link rel="stylesheet" href="../styles/ThreeDStyle.css">
        <link rel="stylesheet" href="./graphStyle.css">
</head>

<body>
        <div class="graph" style="--width:80vw">
                        <?php
                                require_once "getVisits.php";
                                $days = getVisits();
                                krsort($days); 
                                $values = array();
                                foreach ($days as $day => $value){
                                        $values[] = $value;
                                        if (count($values) >= 7){
                                                break;
                                        }
                                }
                                $values = array_reverse($values);
                                $max = max($values);
                                $scale = 1;
                                while($scale*10 < $max/3){
                                        $scale *= 10;
                                }
                                if($scale*5 < $max/3){
                                        $scale *= 5;
                                }
                                else if($scale*2 < $max/3){
                                        $scale *= 2;
                                }
                                $num_lines = ceil($max / $scale);
                                $factor = 40/($scale * $num_lines);
                                foreach ($values as $value){ ?>
                        <div class="cubed bar" style="--value:<?php echo $value*$factor; ?>vw;">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        </div>
                <?php } ?>
                        <div class="lines">
                        <p class="header"> Number of visitors </p>
                <?php for($i = 1; $i <= $num_lines; $i++) { ?>
<div class="line" style='--height:<?= $i*$scale*$factor?>vw;--num:"<?= $i*$scale?>";'></div>
                <?php } ?>
                </div>
        </div>
</body>

</html>
