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
        $this->position();// вводим сетку шахматной доски
        $this->setPosition($position); // Устанавливаем текущую позицию фигуры
        $this->desk = $desk; // доска, но я не уверен в таком впихивании
    }


    public function position()
    {

        $letters = range('A', 'H');
        $numbers = range(1, 8);

        foreach ($letters as $letter) {
            foreach ($numbers as $number) {
                $this->pos["$letter$number"] = null;
            }
        }
    }

    public function setPosition($position) {
        if (array_key_exists($position, $this->pos)) {
            $this->pos[$position] = $this;  // идея о том что устанавливаем фигуру на указанной позиции
        } else {
            throw new Exception("Invalid position: $position");
        }
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