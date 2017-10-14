<?php

namespace App;

/**
 * Class Board
 * @package App
 */
class Board {

    /**
     * Array with cells
     *
     * @var array
     */
    protected $board = [];

    /**
     *
     * The width of the grid
     *
     * @var int
     */
    public $width  = null;
    /**
     *
     * The height of the grid
     *
     * @var int
     */
    public $height = null;

    /**
     * Board constructor.
     *
     * @param int $width
     * @param int $height
     *
     */
    public function __construct($width = 7, $height = 7)
    {
        $this->width = $width;
        $this->height = $height;

        $this->createBoard();

        return $this;

    }

    /**
     *
     * Creates the grid, based on the width and height parameters
     *
     * @return array
     */
    private function createBoard()
    {

        $board = [];

        for($x = 0; $x < $this->width; $x++) {
            if(!isset($board[$x]))
                $board[$x] = [];

            for($y = 0; $y < $this->height; $y++) {
                $board[$x][$y] = 0;

            }

        }

        $this->setBoard($board);

        return $board;

    }

    /**
     * Get the grid
     *
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     *
     * Get the cell
     *
     * @param $x
     * @param $y
     *
     * @return Cell|null
     */
    public function getCell($x, $y) {
        return $this->board[$x][$y];
    }

    /**
     *
     * Set the cell
     *
     * @param $x
     * @param $y
     * @param $value
     *
     * @return Cell|null
     */
    public function setCell($x, $y, $value) {
        return $this->board[$x][$y] = $value;

    }

    /**
     *
     * Set the grid
     *
     * @param array $board
     */
    public function setBoard(array $board)
    {
        $this->board = $board;
    }

    /**
     * @param $x
     * @param $y
     *
     * @return bool
     */
    public function checkSafePlace($x, $y)
    {

        // check all diagonal places bottom right
        for ($xa = $x, $ya = $y; $xa >= 0 && $xa < $this->width && $ya >= 0 && $ya < $this->height; $xa ++, $ya ++) {
            $cell = $this->getCell($xa, $ya);

            if($cell) {
                return false;
            }
        }

        // check all diagonal places top right
        for ($xa = $x, $ya = $y; $xa >= 0 && $xa < $this->width && $ya >= 0 && $ya < $this->height; $xa ++, $ya --) {
            $cell = $this->getCell($xa, $ya);

            if($cell) {
                return false;
            }
        }

        // check all diagonal places top left
        for ($xa = $x, $ya = $y; $xa >= 0 && $xa < $this->width && $ya >= 0 && $ya < $this->height; $xa --, $ya --) {
            $cell = $this->getCell($xa, $ya);

            if($cell) {
                return false;
            }
        }


        // check all diagonal places bottom left
        for ($xa = $x, $ya = $y; $xa >= 0 && $xa < $this->width && $ya >= 0 && $ya < $this->height; $xa --, $ya ++) {
            $cell = $this->getCell($xa, $ya);

            if($cell) {
                return false;
            }
        }

        // check all horizontal
        for ($xa = 0, $ya = $y; $xa >= 0 && $xa < $this->width && $ya >= 0 && $ya < $this->height; $xa ++) {
            $cell = $this->getCell($xa, $ya);

            if($cell) {
                return false;
            }
        }

        // check all vertical
        for ($xa = $x, $ya = 0; $xa >= 0 && $xa < $this->width && $ya >= 0 && $ya < $this->height; $ya ++) {
            $cell = $this->getCell($xa, $ya);

            if($cell) {
                return false;
            }
        }

        if($cell instanceof Queen)
            echo $cell->getId() ." is safe\n";

        return true;

    }


}