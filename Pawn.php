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

    // осторожно возможно полная чушь

    public function move($newPos)
    {
        // Получаем текущую позицию
        $currentPos = $this->position;

        // Преобразуем текущую и новую позицию в индексы и это опять таки дубляж кода
        $currentCol = ord($currentPos[0]) - ord('A'); // Столбец текущей позиции
        $currentRow = 8 - (int)$currentPos[1];       // Строка текущей позиции

        $newCol = ord($newPos[0]) - ord('A');        // Столбец новой позиции
        $newRow = 8 - (int)$newPos[1];              // Строка новой позиции

        // Вычисляем разницу между текущей и новой позицией
        $rowDiff = $newRow - $currentRow;
        $colDiff = abs($newCol - $currentCol);

        // Проверяем, что движение происходит строго по диагонали
        if (abs($rowDiff) !== $colDiff) {
            return false; // я не уверен что это по диогонали
        }

        // Проверка на обычное передвижение (одна клетка)
        if (abs($rowDiff) === 1 && $colDiff === 1) {
            if ($this->desk->getPawn($newPos) === null) {
                // Клетка свободна, перемещаем
                $this->desk->setPawn($this->position, null); // Освобождаем текущую клетку
                $this->desk->setPawn($newPos, $this);        // Устанавливаем на новую клетку
                $this->position = $newPos;                  // Обновляем позицию
                return true;
            }
            return false; // Клетка занята
        }

        // Проверка на прыжок через вражескую шашку
        if (abs($rowDiff) === 2 && $colDiff === 2) {
            // Определяем координаты клетки с вражеской шашкой
            $middleRow = ($currentRow + $newRow) / 2;
            $middleCol = ($currentCol + $newCol) / 2;

            $middlePos = chr(ord('A') + $middleCol) . (8 - $middleRow); // Позиция вражеской шашки
            $middlePawn = $this->desk->getPawn($middlePos);

            if ($middlePawn !== null && $middlePawn->getColor() !== $this->color) {
                // Проверяем, что следующая клетка свободна
                if ($this->desk->getPawn($newPos) === null) {
                    // Убираем вражескую шашку
                    $this->desk->setPawn($middlePos, null);

                    // Перемещаем текущую шашку
                    $this->desk->setPawn($this->position, null); // Освобождаем текущую клетку
                    $this->desk->setPawn($newPos, $this);        // Устанавливаем на новую клетку
                    $this->position = $newPos;                  // Обновляем позицию
                    return true;
                }
            }
            return false; // Прыжок невозможен
        }
        return false; // Движение не соответствует правилам
    }

}