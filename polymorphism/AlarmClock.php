<?php

/**
 * Реализуйте логику работы часов из теории.

 * В режиме настройки будильника (alarm), часы и минуты изменяются независимо и никак друг на друга не
 * влияют (как и в большинстве реальных будильников). То есть если происходит увеличение минут с 59 до 60
 * (сброс на 00), то цифра с часами остается неизменной.

 * Интерфейсными методами часов являются:

clickMode() - нажатие на кнопку Mode
longClickMode() - долгое нажатие на кнопку Mode
clickH() - нажатие на кнопку H
clickM() - нажатие на кнопку M
tick() - при вызове, увеличивает время на одну минуту. Если новое время совпало со временем на будильнике, то часы переключаются в режим срабатывания будильника (bell).
isAlarmOn() - показывает включен ли режим будильника
isAlarmTime() - возвращает true, если время на часах совпадает со временем на будильнике
getMinutes() - возвращает минуты, установленные на часах
getHours() - возвращает часы, установленные на часах
getAlarmMinutes() - возвращает минуты, установленные на будильнике
getAlarmHours() - возвращает часы, установленные на будильнике
getCurrentMode() - возвращает текущий режим (alarm | clock | bell)
Основной спецификацией к данной задачe нужно считать тесты.

AlarmClock.php
 * Реализуйте интерфейсные методы и логику работы часов.

states/AlarmState.php, states/BellState.php, states/ClockState.php
 * Реализуйте логику состояний.
 */

//src/AlarmClock.php

namespace App;

use App\states\ClockState;
use App\states\AlarmState;
use App\states\BellState;

// BEGIN (write your solution here)
class AlarmClock
{
    const STATES = [
        'App\states\ClockState' => 'clock',
        'App\states\AlarmState' => 'alarm',
        'App\states\BellState' => 'bell'
    ];
    public $hours;
    public $alarmHours;
    public $minutes;
    public $alarmMinutes;
    private $state;
    private $onBell = false;

    public function __construct()
    {
        $this->hours = 12;
        $this->alarmHours = 6;
        $this->minutes = 0;
        $this->alarmMinutes = 0;
        $this->setState(ClockState::class);
    }

    public function setState($className)
    {
        $this->state = new $className($this);
    }

    public function clickH()
    {
        // Делегирование
        $this->state->clickH();
    }

    public function clickM()
    {
        // Делегирование
        $this->state->clickM();
    }

    public function getMinutes()
    {
        return $this->minutes;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function getAlarmHours()
    {
        return $this->alarmHours;
    }

    public function getAlarmMinutes()
    {
        return $this->alarmMinutes;
    }

    public function isAlarmOn()
    {
        return $this->onBell === true;
    }

    public function getCurrentMode()
    {
        return self::STATES[get_class($this->state)];
    }

    public function clickMode()
    {
        if ($this->getCurrentMode() === 'clock') {
            $this->setState(AlarmState::class);
        } else {
            $this->setState(ClockState::class);
        }
    }

    public function longClickMode()
    {
        $this->onBell === false ? $this->onBell = true : $this->onBell = false;
    }

    public function isAlarmTime()
    {
        return ($this->getHours() == $this->getAlarmHours()) && ($this->getMinutes() == $this->getAlarmMinutes());
    }

    public function tick()
    {
        $this->minutes += 1;
        if ($this->getCurrentMode() === 'bell') {
            $this->setState(ClockState::class);
        }
        if ($this->minutes >= 60) {
            $this->hours += floor($this->minutes / 60);
            $this->minutes = $this->minutes % 60;
        }
        if ($this->hours >= 24) {
            $this->hours = $this->hours % 24;
        }
        if ($this->isAlarmOn() && $this->isAlarmTime()) {
            $this->setState(BellState::class);
        }
    }
}
// END

//src/states/ClockState.php

<?php

namespace App\states;

use App\AlarmClock;

// BEGIN (write your solution here)
class ClockState
{
    private $clock;

    public function __construct(AlarmClock $clock)
    {
        $this->clock = $clock;
    }

    public function clickH()
    {
        $this->clock->hours === 23 ? $this->clock->hours = 0 : $this->clock->hours += 1;
    }
    public function clickM()
    {
        $this->clock->minutes === 59 ? $this->clock->minutes = 0 : $this->clock->minutes += 1;
    }
}
// END

//src/states/AlarmState.php

<?php

namespace App\states;

use App\AlarmClock;

// BEGIN (write your solution here)
class AlarmState
{
    private $clock;

    public function __construct(AlarmClock $clock)
    {
        $this->clock = $clock;
    }

    public function clickH()
    {
        $this->clock->alarmHours === 23 ? $this->clock->alarmHours = 0 : $this->clock->alarmHours += 1;
    }
    public function clickM()
    {
        $this->clock->alarmMinutes === 59 ? $this->clock->alarmMinutes = 0 : $this->clock->alarmMinutes += 1;
    }
}
// END

//src/states/BellState.php

<?php

namespace App\states;

use App\AlarmClock;

// BEGIN (write your solution here)
class BellState
{
    private $clock;

    public function __construct(AlarmClock $clock)
    {
        $this->clock = $clock;
    }

    public function clickMode()
    {
        $this->clock->setState(ClockState::class);
    }

    public function clickH()
    {
        $this->clock->hours;
    }
    public function clickM()
    {
        $this->clock->minutes;
    }
}
// END
