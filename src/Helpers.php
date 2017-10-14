<?php

use App\Board;

/**
 *
 * Dies and dumps the input
 *
 */
function dd(){

    $args = func_get_args();

    foreach($args as $arg) {
        var_dump($arg);
    }

    die(1);

}

/**
 *
 * Helps to output the board on to the screen
 *
 * @param Board $board
 */
function render(Board $board) {

    $cols = $board->getBoard();

    foreach ($cols as $col) {
        $sep = '-';

        foreach ($col as $cell) {
            $sep .= '--';

            echo '|';

            if($cell instanceof \App\Queen) {
                echo $cell->getId();
            }
            else {
                echo " ";
            }
        }
        echo "|\n";
        echo $sep . "\n";
    }

}