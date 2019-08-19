<?php
/**
 * Класс Time предназначен для создания объекта-времени. Его конструктор принимает на вход количество часов и минут в
 * виде двух отдельных параметров.

<?php

$time = new Time(10, 15);
echo $time; // => 10:15
src\Time.php
 * Добавьте в класс Time статический метод fromString, который позволяет создавать инстансы Time на основе времени
 * переданного строкой формата часы:минуты.

<?php

$time = Time::fromString('10:23');
$this->assertEquals('10:23', $time->toString());
 */
namespace App;

class Time
{
    private $h;
    private $m;

    // BEGIN (write your solution here

    public static function fromString($str)
    {
        [$a, $b] = explode(':', $str);
        return new self($a, $b);
    }
    // END

    public function __construct($h, $m)
    {
        $this->h = $h;
        $this->m = $m;
    }

    public function toString()
    {
        return "{$this->h}:{$this->m}";
    }
}
