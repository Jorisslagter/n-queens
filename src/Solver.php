<?php namespace App;

/**
 * Class Queen Solver
 *
 * Source: https://en.wikipedia.org/wiki/Eight_queens_puzzle
 * Source: http://eightqueen.becher-sundstroem.de/
 *
 * Run in
 *
 * @package App
 */
class Solver {

    /**
     *
     * Try and solve the n-queen problem
     *
     * @param int $grid
     * @param int $nOfQueens
     */
    public function run($grid = 7, $nOfQueens = 7)
    {
        $board = new Board($grid, $grid);

        $last = null;

        $solutionsFound = 0;
        $solutions = [];

        $currentQueenCount = 0;
        while($currentQueenCount < $nOfQueens) {

            $queen = new Queen($currentQueenCount + 1, 0, $currentQueenCount, $board);
            $queen->setParent($last);

            if($queen->findNextSafeSpot()) {
                $last = $queen;
                $currentQueenCount ++;

                if($currentQueenCount == $nOfQueens) {
                    echo "Found next solution!";
                    $solutionsFound ++;
                    $solutions[] = $board->getBoard();

                }
            }

        }

        echo "\nFound solutions: ". count($solutions)." \n";
        dd(render($board));
    }

}