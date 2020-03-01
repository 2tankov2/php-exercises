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
    private $clockTime = ['minutes' => 0, 'hours' => 12];
    private $alarmTime = ['minutes' => 0, 'hours' => 6];
    private $alarmOn = false;

    public function __construct()
    {
        $this->setNextState(states\ClockState::class);
    }

    public function clickMode()
    {
        $this->setNextState($this->state->getNextStateClassName());
    }

    public function longClickMode()
    {
        $this->alarmOn = !$this->alarmOn;
    }

    public function clickH()
    {
        $this->state->incrementH();
    }

    public function clickM()
    {
        $this->state->incrementM();
    }

    public function tick()
    {
        $this->incrementM('clockTime');
        if ($this->clockTime['minutes'] === 0) {
            $this->incrementH('clockTime');
        }
        $this->state->tick();
    }

    public function isAlarmOn()
    {
        return $this->alarmOn;
    }

    public function isAlarmTime()
    {
        return $this->clockTime['minutes'] === $this->alarmTime['minutes']
            && $this->clockTime['hours'] === $this->alarmTime['hours'];
    }

    public function getMinutes()
    {
        return $this->clockTime['minutes'];
    }

    public function getHours()
    {
        return $this->clockTime['hours'];
    }

    public function getAlarmMinutes()
    {
        return $this->alarmTime['minutes'];
    }

    public function getAlarmHours()
    {
        return $this->alarmTime['hours'];
    }

    public function setNextState($className = null)
    {
        $className = $className ?? $this->state->getNextStateClassName();
        $this->state = new $className($this);
    }

    public function getCurrentMode()
    {
        return $this->state->getModeName();
    }

    public function incrementH($timeType)
    {
        $hoursCount = $this->$timeType['hours'];
        $this->$timeType['hours'] = ($hoursCount + 1) % 24;
    }

    public function incrementM($timeType)
    {
        $minutesCount = $this->$timeType['minutes'];
        $this->$timeType['minutes'] = ($minutesCount + 1) % 60;
    }
}
// END

//src/states/ClockState.php

<?php

namespace App\states;

use App\AlarmClock;

// BEGIN (write your solution here)
class ClockState implements State
{
    private $clock;
    private $mode = 'clock';
    private $timeType = 'clockTime';
    private $nextStateClass = AlarmState::class;

    public function __construct($clock)
    {
        $this->clock = $clock;
    }

    public function getNextStateClassName()
    {
        return $this->nextStateClass;
    }

    public function getModeName()
    {
        return $this->mode;
    }

    public function incrementH()
    {
        $this->clock->incrementH($this->timeType);
    }

    public function incrementM()
    {
        $this->clock->incrementM($this->timeType);
    }

    public function tick()
    {
        if ($this->clock->isAlarmOn() && $this->clock->isAlarmTime()) {
            $this->clock->setNextState(BellState::class);
        }
    }
}
// END

//src/states/AlarmState.php

<?php

namespace App\states;

use App\AlarmClock;

// BEGIN (write your solution here)
class AlarmState implements State
{
    private $clock;
    private $mode = 'alarm';
    private $timeType = 'alarmTime';
    private $nextStateClass = ClockState::class;

    public function __construct($clock)
    {
        $this->clock = $clock;
    }

    public function getNextStateClassName()
    {
        return $this->nextStateClass;
    }

    public function getModeName()
    {
        return $this->mode;
    }

    public function incrementH()
    {
        $this->clock->incrementH($this->timeType);
    }

    public function incrementM()
    {
        $this->clock->incrementM($this->timeType);
    }

    public function tick()
    {
        if ($this->clock->isAlarmTime() && $this->clock->isAlarmOn()) {
            $this->clock->setNextState(BellState::class);
        }
    }
}
// END

//src/states/BellState.php

<?php

namespace App\states;

use App\AlarmClock;

// BEGIN (write your solution here)
class BellState implements State
{
    private $clock;
    private $mode = 'bell';
    private $nextStateClass = ClockState::class;

    public function __construct($clock)
    {
        $this->clock = $clock;
    }

    public function getNextStateClassName()
    {
        return $this->nextStateClass;
    }

    public function getModeName()
    {
        return $this->mode;
    }

    public function tick()
    {
        $this->clock->setNextState();
    }

    public function incrementH()
    {
        return false;
    }

    public function incrementM()
    {
        return false;
    }
}
// END
