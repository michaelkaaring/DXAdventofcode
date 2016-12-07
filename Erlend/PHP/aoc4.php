<?php

$alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');


function isReal($letterString)
{
    $index = strpos($letterString, '[');
    $line = substr($letterString, 0, $index);
    $letters = explode('-', $line);

    $sectorId = intval(array_pop($letters));
    $letters = array();

    for ($i = 0; $i < strlen($line); $i++) {
        $letter = substr($line, $i, 1);
        if ($letter != '-' && !is_numeric($letter)) {
            if (!array_key_exists($letter, $letters)) {
                $letters[$letter] = 1;
            } else {
                $letters[$letter] = $letters[$letter] + 1;
            }
        }
    }

    $endIndex = strpos($letterString, ']');
    $checksum = substr($letterString, $index + 1, $endIndex - $index - 1);

    uksort($letters, function ($a, $b) use ($letters) {
        $lenDiff = $letters[$b] - $letters[$a];
        if ($lenDiff == 0) {
            return strcmp($a, $b);
        }
        return $lenDiff;
    });

    if (count($letters) < 5) {
        return false;
    }

    $calculatedChecksum = '';
    $i = 0;
    foreach ($letters as $letter => $count) {
        if ($i < 5) {
            $calculatedChecksum .= $letter;
        }
        $i++;
    }

    if ($calculatedChecksum == $checksum) {
        return $sectorId;
    }

    return false;
}

function translateWord($word, $shift)
{
    $first = ord('a');
    $shift = $shift % 26;

    for ($i = 0; $i < strlen($word); $i++) {
        $letter = substr($word, $i, 1);
        $chr = ord($letter);
        if ($chr + $shift > 122) {
            $chr = $chr + $shift - 26;
            $translatedWord .= chr($chr);
        } else {
            $translatedWord .= chr($chr + $shift);
        }
    }

    return $translatedWord;
}

function translate($roomLetters)
{
    $index = strpos($roomLetters, '[');
    $line = substr($roomLetters, 0, $index);
    $words = explode('-', $line);

    $sectorId = intval(array_pop($words));

    $translatedWords = array();

    foreach ($words as $word) {
        $word = translateWord($word, $sectorId);
        if (strpos($word, 'north') !== false && strpos($word, 'pole') != false) {
            echo $sectorId;exit;
        }
        $translatedWords[] = $word;
    }

    return implode(' ', $translatedWords);
}


$roomKeys = file("aoc4.txt");
foreach ($roomKeys as $roomKey) {
    $result = translate($roomKey);
}
