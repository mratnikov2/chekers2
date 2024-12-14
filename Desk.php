<?php

class Desk
{
    private $yacheika; // обьявил ее и обнулил


    public function __construct()
    { // это для того что бы он автомтически создавал новую сущость
        $this->yacheika = array_fill(0, 8, array_fill(0, 8, null));
        // это специальная функция которая заполняет массив и я не уверен что это правильно

        // Размещение белых шашек (на строках 1, 2, 3, на темных клетках)
        for ($row = 5; $row < 8; $row++) {
            for ($col = 0; $col < 8; $col++) {
                if (($row + $col) % 2 != 0) { // Проверка на темную клетку

                    $coordinates = $this->getPosition($row, $col);

                    // впихивыю метод в цикл
                    $this->yacheika[7 - $row][$col] = new Pawn('white', $coordinates, $this);
                }
            }
        }

        // Размещение черных шашек (на строках 6, 7, 8, на темных клетках)
        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 8; $col++) {
                if (($row + $col) % 2 != 0) { // Проверка на темную клетку
                    $coordinates = $this->getPosition($row, $col);

                    // впихивыю метод в цикл
                    $this->yacheika[7 - $row][$col] = new Pawn('black', $coordinates, $this);

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

    public function getPosition($row, $col) {
        // Преобразуем номер столбца в букву (A-H)
        $column = chr(ord('A') + $col);

        // Преобразуем номер строки (0-7) в шахматную нотацию (8-1)
        $rowNumber = $row + 1;

        // Возвращаем строку позиции
        return $column . $rowNumber;
    }

    public function getPawn($pos) {

        // Разделяем позицию на букву и цифру, но этот код повторяется и я бы его вынес куда-то
        $column = ord($pos[0]) - ord('A'); // Преобразуем букву в индекс столбца (0-7)
        $row = (int) $pos[1] - 1;          // Преобразуем номер строки в индекс массива (1-8 -> 0-7)

        // Проверяем, что индексы в пределах границ доски
        if ($column < 0 || $column >= 8 || $row < 0 || $row >= 8) {
            throw new InvalidArgumentException("Такой границы нет: $pos");
        }

        // Возвращаем клетку доски (null, если клетка пуста, или объект Pawn, если там есть пешка)
        return $this->getCell($row, $column);
    }

    public function getCell($row, $col)
    {
        return $this->yacheika[$row][$col];
    }

    public function setPawn($pos, $pawn)
    {
        // Преобразуем позицию $pos в индексы строки и столбца но этот код повторяется и я бы его вынес куда-то
        $column = ord($pos[0]) - ord('A'); // Преобразуем букву в индекс столбца (0-7)
        $row = 8 - (int) $pos[1];          // Преобразуем шахматную строку (1-8) в индекс массива (0-7)

        // Проверяем, что индексы в пределах границ доски
        if ($column < 0 || $column >= 8 || $row < 0 || $row >= 8) {
            throw new InvalidArgumentException("Invalid position: $pos");
        }

        // Устанавливаем шашку или null на указанную клетку
        $this->yacheika[$row][$column] = $pawn;
    }


}






