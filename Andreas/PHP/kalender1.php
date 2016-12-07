<?php


print("<h1>Kalender1</h1>");

$directions = ['N', 'E', 'S', 'W'];
$route = ['R3', 'L5', 'R1', 'R2', 'L5', 'R2', 'R3', 'L2', 'L5', 'R5', 'L4', 'L3', 'R5', 'L1', 'R3', 'R4', 'R1', 'L3', 'R3', 'L2', 'L5', 'L2', 'R4', 'R5', 'R5', 'L4', 'L3', 'L3', 'R4', 'R4', 'R5', 'L5', 'L3', 'R2', 'R2', 'L3', 'L4', 'L5', 'R1', 'R3', 'L3', 'R2', 'L3', 'R5', 'L194', 'L2', 'L5', 'R2', 'R1', 'R1', 'L1', 'L5', 'L4', 'R4', 'R2', 'R2', 'L4', 'L1', 'R2', 'R53', 'R3', 'L5', 'R72', 'R2', 'L5', 'R3', 'L4', 'R187', 'L4', 'L5', 'L2', 'R1', 'R3', 'R5', 'L4', 'L4', 'R2', 'R5', 'L5', 'L4', 'L3', 'R5', 'L2', 'R1', 'R1', 'R4', 'L1', 'R2', 'L3', 'R5', 'L4', 'R2', 'L3', 'R1', 'L4', 'R4', 'L1', 'L2', 'R3', 'L1', 'L1', 'R4', 'R3', 'L4', 'R2', 'R5', 'L2', 'L3', 'L3', 'L1', 'R3', 'R5', 'R2', 'R3', 'R1', 'R2', 'L1', 'L4', 'L5', 'L2', 'R4', 'R5', 'L2', 'R4', 'R4', 'L3', 'R2', 'R1', 'L4', 'R3', 'L3', 'L4', 'L3', 'L1', 'R3', 'L2', 'R2', 'L4', 'L4', 'L5', 'R3', 'R5', 'R3', 'L2', 'R5', 'L2', 'L1', 'L5', 'L1', 'R2', 'R4', 'L5', 'R2', 'L4', 'L5', 'L4', 'L5', 'L2', 'L5', 'L4', 'R5', 'R3', 'R2', 'R2', 'L3', 'R3', 'L2', 'L5'];
$currentHeading = 0;
$x = 0;
$y = 0;
$grid = [];
$step = 0;
$i = 0;
while ($i < count($route)) {
    $moves = filter_var($route[$i], FILTER_SANITIZE_NUMBER_INT);
    move(substr($route[$i], 0, 1), $moves, $currentHeading, $x, $y, $grid, $step);
    $step = $step +  $moves;
    $i += 1;
}

function move ($direction, $moves, &$currentHeading, &$x, &$y, &$grid, &$step) {
    switch ($currentHeading) {
        case 'N':
            if ($direction == 'L') {
                $currentHeading = 'W';
                plotGridx($grid, $x, $y, (0 - $moves), $step);
                $x = $x - $moves;
            }
            if ($direction == 'R') {
                $currentHeading = 'E';
                plotGridx($grid, $x, $y, $moves, $step);
                $x = $x + $moves;
            }
            break;
        case 'S':
            if ($direction == 'L') {
                $currentHeading = 'E';
                plotGridx($grid, $x, $y, $moves, $step);
                $x = $x + $moves;
            }
            if ($direction == 'R') {
                $currentHeading = 'W';
                plotGridx($grid, $x, $y, (0 - $moves), $step);
                $x = $x - $moves;
            }
            break;
        case 'E':
            if ($direction == 'L') {
                $currentHeading = 'N';
                plotGridy($grid, $x, $y, $moves, $step);
                $y = $y + $moves;
            }
            if ($direction == 'R') {
                $currentHeading = 'S';
                plotGridy($grid, $x, $y, (0 - $moves), $step);
                $y = $y - $moves;
            }
            break;
        case 'W':
            if ($direction == 'L') {
                $currentHeading = 'S';
                plotGridy($grid, $x, $y, (0 - $moves), $step);
                $y = $y - $moves;
            }
            if ($direction == 'R') {
                $currentHeading = 'N';
                plotGridy($grid, $x, $y, $moves, $step);
                $y = $y + $moves;
            }
            break;
        default:
            die("ERROR!");
    }

}

function plotGridx (&$grid, $x, $y, $moves, $step) {
    ($moves > 0) ? $p = 1 : $p = -1;
    while($moves != 0) {
        $x = $x + $p;
        $step += 1;
        $grid['x' . $x . 'y' . $y][$step] = 1;
        $moves = $moves - $p;
    }
}

function plotGridy (&$grid, $x, $y, $moves, $step) {
    ($moves > 0) ? $p = 1 : $p = -1;
    while($moves != 0) {
        $y = $y + $p;
        $step += 1;
        $grid['x' . $x . 'y' . $y][$step] = 1;
        $moves = $moves - $p;
    }
}
$blocks = abs($x) + abs($y);
echo ('BLOCKS: ' . $blocks . '<br>');

foreach ($grid as $key => $num) {
    if(count($num) > 1) {
        var_dump($grid[$key]);
        echo $key . "<br>";
    }
}
