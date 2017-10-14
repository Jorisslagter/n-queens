<?php namespace App;

/**
 * Class Queen
 * @package App
 */
class Queen {

    /**
     * @var int
     */
    public $x = 0;

    /**
     * @var int
     */
    public $y = 0;

    /**
     * @var Queen
     */
    protected $parent = null;

    /**
     * @var Board
     */
    protected $board = null;

    /**
     * @var string
     */
    protected $id = null;


    /**
     * Queen constructor.
     *
     * @param       $id
     * @param       $x
     * @param       $y
     * @param Board $board
     */
    public function __construct($id, $x, $y, Board &$board)
    {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;

        $this->board = $board;

    }

    /**
     *
     * Get the parent queen
     *
     * @return Queen
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     *
     * Set the parent Queen
     *
     * @param Queen|null $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

    }


    /**
     *
     * Moves the queen to the next virtual board cell
     *
     */
    public function step() {

        $x = $this->x + 1;
        $y = $this->y;

        if($x >= $this->board->width) {
            $x = $this->board->width - 1;
        }

        $this->x = $x;
        $this->y = $y;

        echo $this->id ." is stepping to " . $this->y . ":".$this->x."\n";


    }


    /**
     *
     * Handles the position on the queen and the board
     *
     * @param $x
     * @param $y
     */
    public function setPosition($x, $y) {
        $this->board->setCell($this->x, $this->y, 0);

        $this->x = $x;
        $this->y = $y;

        $this->board->setCell($x, $y, $this);
    }

    /**
     *
     * Returns if the current position is safe.
     *
     * @return bool
     */
    public function isSafe()
    {
        $safe = $this->board->checkSafePlace($this->x, $this->y);

        return $safe;
    }

    /**
     *
     */
    public function removeFromBoard()
    {
        $this->board->setCell($this->x, $this->y, 0);
    }

    /**
     *
     * This is the hearth of the algorithm. It helps the Queen to find a new safe spot and signals to the parent queen if she needs to move.
     *
     * @return bool
     */
    public function findNextSafeSpot() {

        // if queen is safe, return out of the function and store the position on the board.
        if($this->isSafe()) {
            echo $this->getId()." is safe \n";
            $this->board->setCell($this->x, $this->y, $this);
            return true;

        }

        // while the queen isn't safe, do the following.

        $tries = 0;
        while(!$this->isSafe()) {

            // Safety measure for making endless loops
            if($tries > 1000) {
                die("STOP, way to many tries. There is something wrong in the algorithm. ");
            }

            // First we reset our current position on the board
            $this->board->setCell($this->x, $this->y, 0);

            // Let's do one step
            $this->step();

            // If the queen has found a safe place. We will place her on that cell.
            if($this->isSafe()) {
                $this->board->setCell($this->x, $this->y, $this);

                echo "Queen ". $this->getId() ." is safe.\n";

                return true;
            }

            // For the fun and debugging purpose, we show what we are moving at the moment. And it just looks good.
            render($this->board);

            // If the queen tried all her options in this row, we remove her from the board and ask her parent to try the next safe option.
            if ($this->x >= $this->board->width -1) {

                echo "We remove ". $this->getId() ." from board\n";

                // We remove the current queen. Reset here X position.
                $this->removeFromBoard();
                $this->x = 0;

                // We render her last 'remove action';
                render($this->board);


                if($this->parent) {
                    // Power of recursion. Let us ask the parent to look a better spot.
                    $this->parent->findNextSafeSpot();
                }

            }

            $tries ++;
        }

    }

    /**
     *
     * Returns the current Queen ID
     *
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }
}