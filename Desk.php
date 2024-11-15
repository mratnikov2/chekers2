<?php

class Desk
{
    private $yacheika; // обьявил ее и обнулил


    public function __construct()
    { // это для того что бы он автомтически создавал новую сущость
        $this->yacheika = array_fill(0, 8, array_fill(0, 8, null));
        // это специальная функция которая заполняет массив и я не уверен что это правильно

        // Размещение белых шашек
        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 8; $col++) {
                if (($row + $col) % 2 != 0) { // Проверка на темную клетку
                    $this->yacheika[$row][$col] = new Pawn('white');
                }
            }
        }

        // Размещение черных шашек (на последних трех рядах, на темных клетках)
        for ($row = 5; $row < 8; $row++) {
            for ($col = 0; $col < 8; $col++) {
                if (($row + $col) % 2 != 0) { // Проверка на темную клетку
                    $this->yacheika[$row][$col] = new Pawn('black');
                }
            }
        }

    }

    public function repr()
    {
        foreach ($this->yacheika as $key => $value) {
            if ($value === null) {
                echo " "; // Если ячейка пустая, печатаем пробел
            } else {
                echo $value->repr(); // Если ячейка занята, печатаем символ фигуры
            }

            // Переход на новую строку после каждого ряда (например, после H1, H2 и т.д.)
            if (strpos($key, '8') !== false) {
                echo PHP_EOL;
            }
        }
    }
}



