<?php

include 'Pawn.php';
include 'Desk.php';

$desk = new Desk;
$test1 = new Pawn('white', 'E2', $desk);
$test2 = new Pawn('black', 'H1', $desk);


$desk->repr();

for ($row = 0; $row < 8; $row++) {
    for ($col = 0; $col < 8; $col++) {
        $position = $desk->getPosition($row, $col);

        // Получаем клетку доски через публичный метод getCell
        $cell = $desk->getCell($row, $col);

        if ($cell !== null && $cell->isWhite()) {
            echo "\nПозиция для белой шашки в строке $row и столбце $col: $position\n";
        }

        if ($cell !== null && $cell->isBlack()) {
            echo "\nПозиция для черной шашки в строке $row и столбце $col: $position\n";
        }
    }
}




