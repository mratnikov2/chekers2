<?php

class Pawn
{
    private $pawn;
    public $pos = [];
    public $color;
    public $desk = null; // я боюсь будут конфликты имен

    public function __construct($color, $position, $desk) {

        if ($color !== 'white' && $color !== 'black') {
            throw new InvalidArgumentException("Color must be either 'white' or 'black'.");
        }

        $this->color = $color;//  цвет фигуры
        $this->pos = $position;
        $this->desk = $desk; // доска, но я не уверен в таком впихивании
    }

    // не уверен что я делаю
    public function index(){
        $massiv = []; //обьявили массив в который будем записывать
        $column = ord(strtoupper($this->pos[0])) - ord('A'); // Преобразуем букву в индекс столбца
        $row = 8 - intval($this->pos[1]); // Преобразуем цифру в индекс строки
        $massiv = [$row, $column]; // его можно было и не обьявлять на 23 а сразу на 26 (это дубляж)

        return $massiv;
    }

    public function position()
    {
        return $this->pos;
    }

    public function isWhite()
    {
        return $this->color === 'white';
    }

    public function isBlack()
    {
        return $this->color === 'black';
    }

    public function repr() {
        if($this->isWhite()) {
            return "о";
        } else {
            return "*";
        }
    }

}