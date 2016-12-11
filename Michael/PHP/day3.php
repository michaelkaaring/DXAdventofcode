<?php

$triangles = file('./day3-triangles.txt');

$possibleTriangles = 0;
$possibleTriangles2 = 0;

foreach ($triangles as $triangle) {
  $triangleWidths = explode('  ', $triangle);
  sort($triangleWidths, SORT_NUMERIC);
  if(($triangleWidths[0]+$triangleWidths[1]) > $triangleWidths[2]){
    $possibleTriangles = $possibleTriangles+1;
  }

  foreach($triangleWidths as $triangle2) {
    if((100 <= $triangle2) && ($triangle2 <= 999)){
      $hundredArray = str_split($triangle2);
      echo $triangle2.'<br>';
      sort($hundredArray, SORT_NUMERIC);
      print_r($hundredArray);
      if(($hundredArray[0]+$hundredArray[1]) > $hundredArray[2]){
        $possibleTriangles2 = $possibleTriangles2+1;
      }
    }
  }

}

// Part 2
// $tringlesString = implode(' ', $triangles);
// $resortedArray = explode(' ', $tringlesString);
//
// //$triangleSides
//
// for ($i=0; $i <= count($resortedArray); $i++) {
//   echo $resortedArray[$i].'<br>';
//   if(strlen($resortedArray[$i]) == 3){
//     $hundredArray = explode('', $resortedArray[$i]);
//     sort($hundredArray, SORT_NUMERIC);
//     print_r($hundredArray);
//     if(($hundredArray[0]+$hundredArray[1]) > $hundredArray[2]){
//       $possibleTriangles2 = $possibleTriangles2+1;
//     }
//   }
// }

echo 'PossibleTriangles in part 1: '.$possibleTriangles;
echo '<br>';
echo 'PossibleTriangles in part 2: '.$possibleTriangles2;


 ?>
