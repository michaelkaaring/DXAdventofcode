<?php

define('NORTH', 0);
define('SOUTH', 1);
define('EAST', 2);
define('WEST', 3);

class AoC1 {
    private $x = 0, $y = 0;
    private $direction = NORTH;
    private $map = array();
    private $i = 0;


    function changeDirection($rotate)
    {
        switch ($this->direction) {
            case NORTH:
                $this->direction = $rotate == 'L' ? WEST : EAST;
                break;
            case WEST:
                $this->direction = $rotate == 'L' ? SOUTH : NORTH;
                break;
            case SOUTH:
                $this->direction = $rotate == 'L' ? EAST : WEST;
                break;
            case EAST:
                $this->direction = $rotate == 'L' ? NORTH : SOUTH;
                break;
        }
    }


    function advance($blocks)
    {
        switch ($this->direction) {
            case NORTH:
                $this->y += $blocks;
                break;
            case SOUTH:
                $this->y -= $blocks;
                break;
            case EAST:
                $this->x += $blocks;
                break;
            case WEST:
                $this->x -= $blocks;
                break;
        }
    }


    function move($direction, $blocks)
    {
        $startX = $this->x;
        $startY = $this->y;

        $this->changeDirection($direction);
        $this->advance($blocks);

        switch ($this->direction) {
            case NORTH:
                for ($a = $startY; $a < $this->y; $a++) {
                    if ($this->fillMap($this->x, $a)) {
                        $this->y = $a;
                        return true;
                    }
                }
                break;
            case SOUTH:
                for ($a = $startY; $a > $this->y; $a--) {
                    if ($this->fillMap($this->x, $a)) {
                        $this->y = $a;
                        return true;
                    }
                }
                break;
            case EAST:
                for ($a = $startX; $a < $this->x; $a++) {
                    if ($this->fillMap($a, $this->y)) {
                        $this->x = $a;
                        return true;
                    }
                }
                break;
            case WEST:
                for ($a = $startX; $a > $this->x; $a--) {
                    if ($this->fillMap($a, $this->y)) {
                        $this->x = $a;
                        return true;
                    }
                }
        }
        $this->i += 1;
        return false;
    }

    function fillMap($x, $y)
    {
        printf("%4s%4s\n", $x, $y);
        if (!array_key_exists($x, $this->map)) {
            $this->map[$x] = array();
            if (!array_key_exists($y, $this->map[$x])) {
                $this->map[$x][$y] = 0;
            }
        }
        if ($this->map[$x][$y] === 1) {
            return true;
        }
        $this->map[$x][$y] = $this->map[$x][$y] + 1;
    }


    function getBlocks()
    {
        $x = $this->x;
        $y = $this->y;

        if ($x < 0) {
            $x = -$x;
        }
        if ($y < 0) {
            $y = -$y;
        }

        return $x + $y;
    }
}


$aoc = new AoC1();

//$input = "R8, R4, R4, R8";
$input = "R2, L3, R2, R4, L2, L1, R2, R4, R1, L4, L5, R5, R5, R2, R2, R1, L2, L3, L2, L1, R3, L5, R187, R1, R4, L1, R5, L3, L4, R50, L4, R2, R70, L3, L2, R4, R3, R194, L3, L4, L4, L3, L4, R4, R5, L1, L5, L4, R1, L2, R4, L5, L3, R4, L5, L5, R5, R3, R5, L2, L4, R4, L1, R3, R1, L1, L2, R2, R2, L3, R3, R2, R5, R2, R5, L3, R2, L5, R1, R2, R2, L4, L5, L1, L4, R4, R3, R1, R2, L1, L2, R4, R5, L2, R3, L4, L5, L5, L4, R4, L2, R1, R1, L2, L3, L2, R2, L4, R3, R2, L1, L3, L2, L4, L4, R2, L3, L3, R2, L4, L3, R4, R3, L2, L1, L4, R4, R2, L4, L4, L5, L1, R2, L5, L2, L3, R2, L2";
$directions = explode(' ', $input);

foreach ($directions as $direction) {
    $dir = substr($direction, 0, 1);
    $blocks = substr($direction, 1);
    if ($aoc->move($dir, $blocks)) {
        echo "{$aoc->getBlocks()}\n";
        exit;
    }
}

echo "No such place??\n";
echo "{$aoc->getBlocks()}\n";



















