<?php
/**
 * Реализуйте недостающие части класса Timer, который описывает собой таймер обратного отсчета. Необходимо дописать
 * конструктор принимающий на вход три параметра: секунды, минуты (необязательный) и часы (необязательный). Конструктор
 * должен подсчитать общее количество секунд для переданного времени и записать его в свойство secondsCount.

 * Воспользуйтесь константой SEC_PER_MIN для перевода минут в секунды (через умножение)
 * Реализуйте дополнительную константу SEC_PER_HOUR и воспользуйтесь ей для перевода часов в секунды
<?php

$timer = new Timer(10);
$this->assertEquals(10, $timer->getLeftSeconds());
 */
namespace App;

class Timer
{
    const SEC_PER_MIN = 60;

    // BEGIN (write your solution here)
    const SEC_PER_HOUR = self::SEC_PER_MIN * 60;

    public $secondsCount;

    public function __construct($sec, $min = 0, $hour = 0)
    {
        $this->secondsCount = $sec + $min * self::SEC_PER_MIN + $hour * self::SEC_PER_HOUR;
    }
    // END

    public function getLeftSeconds()
    {
        return $this->secondsCount;
    }

    public function tick()
    {
        $this->secondsCount--;
    }
}
