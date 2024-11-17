<?php

include 'Pawn.php';
include 'Desk.php';

$desk = new Desk;
$test1 = new Pawn('white', 'E2', $desk);
$test2 = new Pawn('black', 'H1', $desk);


$desk->repr();


