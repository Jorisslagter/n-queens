<?php
use App\Solver;

require __DIR__ . '/vendor/autoload.php';

/*
 * I've started to create a brute force n-queen calculator. Which I found 6 unique solutions. It worked, but I wasn't happy with the process.
 * After I started to research on the internet how many solutions there should be (I learned there are 40 in total) and that it's less hard on the processor to do it recursively.
 * So I changed my strategy a nd I tried a different way: The recursive way. This took some extra time,
 * but I think it's worth it.
 *
 * In my final run, I learned to understand the n-queen puzzle and found one solution.
 * But didn't yet found a way to seek for the other solutions.
 *
 * Found solution:
        |1| | | | | | |
        ---------------
        | | | | |5| | |
        ---------------
        | |2| | | | | |
        ---------------
        | | | | | |6| |
        ---------------
        | | |3| | | | |
        ---------------
        | | | | | | |7|
        ---------------
        | | | |4| | | |
        ---------------
 *
 * To run. Open in browser and view the source:
 * view-source:http://queens.app/
 *
 * Start time: 13-10-2017 18:00
 * End time: 13-10-2017 23:00
 *
 * Total time: 5 hours of which 2 hours of thinking, brainstorming and researching.
 *
 * Possibilities 40 of which 6 are unique.
 * Source: https://math.stackexchange.com/questions/1872444/how-many-solutions-are-there-to-an-n-by-n-queens-problem
 * and http://oeis.org/A000170/list
 *
 * I've tested the code on a 7x7 grid and 7 queens. It's capable of seeking for the first solution.
 * I started to create a solution finder, but I'am already over time.
 *
 * I've limited it's capacity to 1000 tries, but I am sure it is capable of doing complicated situations.
 * Bare in mind that PHP is known of it's memory limits and I needed to do this fast. So I don't really know
 * what the limits are at this moment.
 *
 * To run the code:
 * $solver = new Solver();
 * $solver->run(7, 7);
 *
 */


$solver = new Solver();
$solver->run(7, 7);
