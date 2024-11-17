<?php

class Desk
{
    private $yacheika; // обьявил ее и обнулил


    public function __construct()
    { // это для того что бы он автомтически создавал новую сущость
        $this->yacheika = array_fill(0, 8, array_fill(0, 8, null));
        // это специальная функция которая заполняет массив и я не уверен что это правильно

        // Размещение белых шашек первая версия
//        for ($row = 0; $row < 3; $row++) {
//            for ($col = 0; $col < 8; $col++) {
//                if (($row + $col) % 2 != 0) { // Проверка на темную клетку
//                    $this->yacheika[$row][$col] = new Pawn('white', 'A2',$this);
//
//                }
//            }

        // Размещение белых шашек (на строках 1, 2, 3, на темных клетках)
        for ($row = 5; $row < 8; $row++) {
            for ($col = 0; $col < 8; $col++) {
                if (($row + $col) % 2 != 0) { // Проверка на темную клетку
                    $this->yacheika[7 - $row][$col] = new Pawn('white', 'A2', $this);
                } else {
                    $this->yacheika[7 - $row][$col] = null; // Светлая клетка остаётся пустой
                }
            }
        }

        // Заполнение строк 4 и 5 (пустые клетки)
        for ($row = 3; $row < 5; $row++) {
            for ($col = 0; $col < 8; $col++) {
                $this->yacheika[$row][$col] = null; // Все клетки пустые
            }
        }

        // Размещение черных шашек (на строках 6, 7, 8, на темных клетках)
        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 8; $col++) {
                if (($row + $col) % 2 != 0) { // Проверка на темную клетку
                    $this->yacheika[7 - $row][$col] = new Pawn('black', 'B1', $this);
                } else {
                    $this->yacheika[7 - $row][$col] = null; // Светлая клетка остаётся пустой
                }
            }
        }


    }


    public function repr()
    {
        // нужно что бы понять где шашка
        echo " abcdefgh\n";

        for ($row = 7; $row >= 0; $row--) { // Обратный порядок строк
            // Вывод номера строки
            echo($row + 1);

            for ($col = 0; $col < 8; $col++) {
                $cell = $this->yacheika[$row][$col];

                // Вывод содержимого ячейки: пробел или результат метода repr()
                if ($cell === null) {
                    echo " ";
                } else {
                    echo $cell->repr(); // Вызываем метод repr объекта Pawn
                }
            }

            echo "\n"; // Переход на новую строку
        }
    }
}


