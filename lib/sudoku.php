<?php
// set 5 minute time limit for sudoku solve
set_time_limit(300);

include 'SudokuGrid.php';
include 'SudokuSolver.php';

$solver = new SudokuSolver($_POST);

$validate = $solver->validate();
$error = $solver->getError();

if (isset($error) && strpos($error,'Unsolvable') === false) {
    $solve = $solver->solve();
} else {
    $solve = $validate;
}

$grid = new SudokuGrid($solve, $error);
?>
