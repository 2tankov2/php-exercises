<?php

/**
 * Random.php
 * Реализуйте генератор рандомных чисел, представленный классом Random. Интерфейс объекта включает в себя три функции:

 * Конструктор. Принимает на вход seed, начальное число генератора псевдослучайных чисел
 * getNext — метод, возврающающий новое случайное число
 * reset — метод, сбрасывающий генератор на начальное значение
<?php

$seq = new Random(100);
$result1 = $seq->getNext();
$result2 = $seq->getNext();

$result1 != $result2; // => true

$seq->reset();

$result21 = $seq->getNext();
$result22 = $seq->getNext();

$result1 == $result21; // => true
$result2 == $result22; // => true
 * Простейший способ реализовать случайные числа — линейный конгруэнтный метод.
 */

namespace App;

// BEGIN (write your solution here)
class Random
{
    private $seed;
    private $nextNumber;
    const A = 5;
    const B = 3;
    const C = 11;

    public function __construct($seed)
    {
        $this->nextNumber = $this->seed = $seed;
    }

    public function getNext()
    {
        $this->nextNumber = (self::A * $this->nextNumber + self::B) % self::C;
        return $this->nextNumber;
    }

    public function reset()
    {
        $this->nextNumber = $this->seed;
    }
}
// END


// BEGIN
class Random
{
    protected $seed;
    protected $init;

    public function __construct($seed)
    {
        $this->seed = $seed;
        $this->init = $seed;
    }

    public function reset()
    {
        $this->seed = $this->init;
    }

    public function getNext()
    {
        $a = 45 + $this->init;
        $c = 21 + $this->init;
        $m = 67 + $this->init;

        $this->seed = ($a * $this->seed + $c) % $m;

        return $this->seed;
    }
}
// END