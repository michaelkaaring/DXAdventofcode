<?php

$times = 0;

function isTriangle($a, $b, $c)
{
    global $times;
    $times++;
//    printf("%4s%4s%4s\n", $a, $b, $c);

    if ($a + $b <= $c) {
        return false;
    }
    if ($a + $c <= $b) {
        return false;
    }
    if ($b + $c <= $a) {
        return false;
    }
    return true;
}

function parseLine($line)
{
    $elements = explode(' ', $line);
    $result = array();
    foreach ($elements as $element) {
        if (strlen($element) > 0) {
            $result[] = intval($element);
        }
    }
    return $result;
}

$triangles = file('aoc3.txt');
$errors = 0;
$data = array();
foreach ($triangles as $triangle) {
    $data[] = parseLine($triangle);
}


for ($i = 0; $i < count($data); $i += 3) {
//    echo $i . "\n";
    if(!isTriangle(
                    $data[$i][0],
                    $data[$i+1][0],
                    $data[$i+2][0]
        ))
    {
        $errors++;
    }
    if(!isTriangle(
                    $data[$i][1],
                    $data[$i+1][1],
                    $data[$i+2][1]
        ))
    {
        $errors++;
    }
    if(!isTriangle(
                    $data[$i][2],
                    $data[$i+1][2],
                    $data[$i+2][2]
        ))
    {
        $errors++;
    }

}

echo count($data) - $errors;