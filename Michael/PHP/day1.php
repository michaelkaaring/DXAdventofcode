<?php

error_reporting(-1);
$input = "R4, R3, L3, L2, L1, R1, L1, R2, R3, L5, L5, R4, L4, R2, R4, L3, R3, L3, R3, R4, R2, L1, R2, L3, L2, L1, R3, R5, L1, L4, R2, L4, R3, R1, R2, L5, R2, L189, R5, L5, R52, R3, L1, R4, R5, R1, R4, L1, L3, R2, L2, L3, R4, R3, L2, L5, R4, R5, L2, R2, L1, L3, R3, L4, R4, R5, L1, L1, R3, L5, L2, R76, R2, R2, L1, L3, R189, L3, L4, L1, L3, R5, R4, L1, R1, L1, L1, R2, L4, R2, L5, L5, L5, R2, L4, L5, R4, R4, R5, L5, R3, L1, L3, L1, L1, L3, L4, R5, L3, R5, R3, R3, L5, L5, R3, R4, L3, R3, R1, R3, R2, R2, L1, R1, L3, L3, L3, L1, R2, L1, R4, R4, L1, L1, R3, R3, R4, R1, L5, L2, R2, R3, R2, L3, R4, L5, R1, R4, R5, R4, L4, R1, L3, R1, R3, L2, L3, R1, L2, R3, L3, L1, L3, R4, L4, L5, R3, R5, R4, R1, L2, R3, R5, L5, L4, L1, L1";
$inputArray = explode(', ', $input);

$compass = 0; // 0 = North, 1 = East, 2 = South, 3 = West
$x = 0;
$y = 0;
$i = 0;

foreach ($inputArray as $key => $value) {
  if(strpos($value, 'L') !== false){
    goLeft($value);
  }elseif(strpos($value, 'R') !== false){
    goRight($value);
  }
}


function goLeft($dir){
  global $compass;
    if($compass == 0){
      $compass = 3;
    }else{
      $compass--;
    }
    walkSteps(preg_replace("/[^0-9]/", '', $dir));
}

function goRight($dir){
  global $compass;
    if($compass == 3){
      $compass = 0;
    }else{
      $compass++;
    }
    walkSteps(preg_replace("/[^0-9]/", '', $dir));
}

function walkSteps($steps){
  global $compass, $x, $y, $i, $inputArray;

  switch($compass){
    case 0:
      $y += $steps;
    break;
    case 1:
      $x += $steps;
    break;
    case 2:
      $y -= $steps;
    break;
    case 3:
      $x -= $steps;
    break;
  }

  $i++;

  if($i == count($inputArray)){
    echo abs($x) + abs($y);
  }
}


 ?>
