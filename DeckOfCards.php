<?php

/**
 * src\DeckOfCards.php
 * Реализуйте класс DeckOfCards, который описывает колоду карт и умеет её мешать.

 * Конструктор класса принимает на вход массив, в котором перечислены номиналы карт в единственном экземпляре,
 * например, [6, 7, 8, 9, 10, 'king'].

 * Реализуйте публичный метод getShuffled, с помощью которого можно получить полную колоду в виде отсортированного
 * случайным образом массива.

 * Примечания
 * В "полной" колоде каждая карта встречается 4 раза — для простоты не учитываем масть.
 * Примеры
<?php

$deck = new DeckOfCards([2, 3]);
$deck->getShuffled(); // [2, 3, 3, 3, 2, 3, 2, 2]
$deck->getShuffled(); // [3, 3, 2, 2, 2, 3, 3, 2]
 * Подсказки
 * Используйте функцию collect для оборачивания массивов
 * Документация по доступным функциям https://laravel.com/docs/5.6/collections
 */

namespace App;

// BEGIN (write your solution here)
class DeckOfCards
{
    private $cards;

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function getShuffled()
    {
        $collection = collect($this->cards);
        
        $size = $collection->count() + 3;
        
        $result = $collection->pad($size, $collection)->flatten()->shuffle()->all();

        return $result;
    }
}
// END

// BEGIN
class DeckOfCards
{
    private $cards;

    public function __construct(array $types)
    {
        $this->cards = collect($types)
                ->map(function ($card) {
                return array_fill(0, 4, $card);
            })
            ->flatten();
    }

    public function getShuffled(): array
    {
        return $this->cards->shuffle()->all();
    }
}
// END
