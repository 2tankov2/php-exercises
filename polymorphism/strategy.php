<?php

/**
 * TicTacToe – известная игра в крестики нолики, на поле 3x3. В этом задании, вам предстоит реализовать
 * данную игру. Основной движок игры находится в файле TicTacToe.php. В директории strategies находится код,
 * который отвечает за поведение AI (искусственный интелект!). В зависимости от выбранного уровня игры,
 * включается либо Easy стратегия, либо Normal.

 * Задание специально построено так, чтобы предоставить вам максимальную свободу в организации кода.
 * Результат будет хорошей лакмусовой бумажкой, по которой можно оценить насколько архитектурная тема
 * была понята.

src/TicTacToe.php
 * Реализуйте класс TicTacToe, который представляет собой игру крестики-нолики. Принцип его работы описан
 * в коде ниже:

 * По умолчанию выбран easy уровень. Его можно изменить, передав в конструктор строку 'normal'
$game = new TicTacToe();
 * Если переданы аргументы, то ходит игрок. Первый аргумент – строка, второй – столбец.
$game->go(2, 2);
 * Ход компьютера
$game->go();
$game->go(1, 2);
$game->go();
 * Метод go возвращает true если текущий ход победный и false в ином случае
$isWinner = $game->go(3, 2); // true

src/strategies/Easy.php
 * Реализуйте стратегию, которая пытается заполнить поля, пробегаясь построчно слева направо и сверху вниз.
 * Как только она встречает свободное поле, то вставляет туда значение.

src/strategies/Normal.php
 * Реализуйте стратегию, которая пытается заполнить поля, пробегаясь построчно снизу вверх и слева направо. 
 * Как только она встречает свободное поле, то вставляет туда значение.
 */

// src/TicTakToe.php

<?php

namespace App;

const DATAWINS = [
        [[1, 1], [2, 2], [3, 3]],
        [[3, 1], [2, 2], [1, 3]],
        [[1, 1], [1, 2], [1, 3]],
        [[2, 1], [2, 2], [2, 3]],
        [[3, 1], [3, 2], [3, 3]],
        [[1, 1], [2, 1], [3, 1]],
        [[1, 2], [2, 2], [3, 2]],
        [[1, 3], [2, 3], [3, 3]]
    ];

class TicTacToe
{
    // BEGIN (write your solution here)
    private $strategy;
    private $dataO = [];
    private $step = 0;

    public function __construct($lavel = 'easy')
    {
        if ($lavel === 'easy') {
            $this->strategy = new strategies\Easy();
        } elseif ($lavel === 'normal') {
            $this->strategy = new strategies\Normal();
        }
    }

    public function getDataO()
    {
        return $this->dataO;
    }

    public function stepStrategy()
    {
        $step = $this->strategy->popStepInitialData();
        if (!in_array($step, $this->dataO)) {
            $this->strategy->setStep($step);
        } else {
            self::stepStrategy();
        }
    }

    public function winCheck($data)
    {
        foreach (DATAWINS as $row) {
            if (
                in_array($row[0], $data)
                && in_array($row[1], $data)
                && in_array($row[2], $data)
            ) {
                return true;
            }
        }
    }

    public function go($row = null, $col = null)
    {
        $this->step += 1;
        if ($row && $col) {
            $this->dataO[] = [$row, $col];
        } else {
            self::stepStrategy();
        }
        if ($this->step < 5) {
            return false;
        } elseif (
            self::winCheck($this->strategy->getDataX())
            || self::winCheck($this->dataO)
        ) {
            return true;
        }
        return false;
    }

    // END
}

// src/Easy.php

<?php

namespace App\strategies;

class Easy
{
    // BEGIN (write your solution here)
    private $initialData = [[3, 3], [3, 2], [3, 1],
                            [2, 3], [2, 2], [2, 1],
                            [1, 3], [1, 2], [1, 1]];
    private $dataX = [];

    public function getDataX()
    {
        return $this->dataX;
    }

    public function setStep($step)
    {
        $this->dataX[] = $step;
    }

    public function popStepInitialData()
    {
        return array_pop($this->initialData);
    }
    // END
}

// src/Normal.php

<?php

namespace App\strategies;

class Normal
{
    // BEGIN (write your solution here)
    private $initialData = [[1, 3], [1, 2], [1, 1],
                            [2, 3], [2, 2], [2, 1],
                            [3, 3], [3, 2], [3, 1]];
    private $dataX = [];

    public function getDataX()
    {
        return $this->dataX;
    }

    public function setStep($step)
    {
        $this->dataX[] = $step;
    }

    public function popStepInitialData()
    {
        return array_pop($this->initialData);
    }
    // END
}
