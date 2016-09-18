<?php
include 'resources/library/sudoku.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sudoku Auto Solver</title>

<link rel="stylesheet" href="css/sudoku.css">

</head>

<body>
<div id="container">
    <div id="title">
        <h1>Sudoku Auto Solver</h1>
    </div>

    <div id="grid">
        <?php echo $grid->makeGrid(); ?>
    </div>
</div>

</body>

</html>
