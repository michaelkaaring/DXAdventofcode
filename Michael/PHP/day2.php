<?php

$keypad = array(
  array(1,2,3),
  array(4,5,6),
  array(7,8,9)
);

$keypad2 = array(
    array("#","#",1,"#","#"),
    array("#",2,3,4,"#"),
    array(5,6,7,8,9),
    array("#","A","B","C","#"),
    array("#","#","D","#","#")
);

//Starts at 5
$finger = array(1,1);
$finger2 = array(2,0);

$pincode1 = "";
$pincode2 = "";

$directions = file('./day2-directions.txt');


foreach ($directions as $dir) {
  $direction = str_split($dir);
  for ($i=1; $i <= count($direction); $i++) {
    switch($direction[$i]){
      case "U":
        goUp();
      break;
      case "R":
        goRight();
      break;
      case "D":
        goDown();
      break;
      case "L":
        goLeft();
      break;
    }

    if($i == count($direction)){
      getFingerPos();
    }
  }
};



function getFingerPos(){
  global $finger, $finger2, $keypad, $keypad2, $pincode, $pincode2;
  $pincode = $pincode.$keypad[$finger[0]][$finger[1]];
  $pincode2 = $pincode2.$keypad2[$finger2[0]][$finger2[1]];
}



// Finger movements

function goUp(){
  global $finger, $finger2, $keypad2;
  if($finger[0] != 0){
    $finger[0] = $finger[0]-1;
  }
  if($keypad2[$finger2[0]-1][$finger2[1]] != "#" && $finger2[0] != 0){
    $finger2[0] = $finger2[0]-1;
  }
}

function goRight(){
  global $finger, $finger2, $keypad2;
  if($finger[1] != 2){
    $finger[1] = $finger[1]+1;
  }
  if($keypad2[$finger2[0]][$finger2[1]+1] != "#" && $finger2[1] != 4){
    $finger2[1] = $finger2[1]+1;
  }
}

function goDown(){
  global $finger, $finger2, $keypad2;
  if($finger[0] != 2){
    $finger[0] = $finger[0]+1;
  }
  if($keypad2[$finger2[0]+1][$finger2[1]] != "#" && $finger2[0] != 4){
    $finger2[0] = $finger2[0]+1;
  }
}

function goLeft(){
  global $finger, $finger2, $keypad2;
  if($finger[1] != 0){
    $finger[1] = $finger[1]-1;
  }
  if($keypad2[$finger2[0]][$finger2[1]-1] != "#" && $finger2[1] != 0){
    $finger2[1] = $finger2[1]-1;
  }
}



echo "Code for part 1 is: ".$pincode;
echo '<br />';
echo "Code for part 2 is: ".$pincode2;





 ?>
