<?php


/*
    1
  2 3 4
5 6 7 8 9
  A B C
    D
 */

class AoC2 {
    private $keyPad = array(
        array(0,  0,   1,   0,  0),
        array(0,  2,   3,   4,  0),
        array(5,  6,   7,   8,  9),
        array(0, 'A', 'B', 'C', 0),
        array(0,  0,  'D',  0,  0),
    );

    private $x = 0;
    private $y = 2;

    function move($direction)
    {
        switch ($direction) {
            case 'L':
                if($this->x > 0 && $this->keyPad[$this->y][$this->x - 1] !== 0) $this->x--;
                break;
            case 'R':
                if($this->x < 4 && $this->keyPad[$this->y][$this->x + 1] !== 0) $this->x++;
                break;
            case 'U':
                if($this->y > 0 && $this->keyPad[$this->y - 1][$this->x] !== 0) $this->y--;
                break;
            case 'D':
                if($this->y < 4 && $this->keyPad[$this->y + 1][$this->x] !== 0) $this->y++;
        }
    }

    function getNumber() {
        return $this->keyPad[$this->y][$this->x];
    }
}

$aoc2 = new AoC2();

$codeLines = file('aoc2.txt');

foreach ($codeLines as $codeLine) {
    for ($i = 0; $i < strlen($codeLine); $i++) {
        $aoc2->move(substr($codeLine, $i, 1));
    }
    echo $aoc2->getNumber();
}

