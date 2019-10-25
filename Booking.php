<?php

/**
 * Booking — процесс бронирования чего-либо. В интернете существует множество сайтов, предлагающих бронирование машин,
 * квартир, домов, самолётов и многого другого. Несмотря на то, что такие сайты предлагают разные услуги, букинг везде
 * работает почти идентично. Выбираются нужные даты и, если они свободны, производится бронирование.

src\Booking.php
 * Реализуйте класс Booking, который позволяет бронировать номер отеля на определённые даты. Единственный интерфейс
 * класса — функция book, которая принимает на вход две даты в текстовом формате. Если бронирование возможно, то метод
 * возвращает true и выполняет бронирование (даты записываются во внутреннее состояние объекта).

 * Подсказки
 * По обычаям гостиничного сервиса время заселения в номер — после полудня первого дня, а время выселения — до полудня
 * последнего дня. Конкретные часы варьируются в разных отелях. Но в данной практике это не важно, главное понять принцип,
 * по которому указываются даты:

<?php

$booking = new Booking();

// забронировать номер на два дня
$booking->book('10-11-2008', '12-11-2008');

// бронь невозможна, 11-го числа номер будет занят
$booking->book('11-11-2008', '15-11-2008');

// бронь возможна, потому что 12-го числа номер освободится
$booking->book('12-11-2008', '13-11-2008');

// бронь невозможна, съём, сроком менее одного дня, обычно не практикуется
$booking->book('17-11-2008', '17-11-2008');

// бронь возможна, съём номера на один день
$booking->book('17-11-2008', '18-11-2008');
 * Пример
<?php

$booking = new Booking();
$booking->book('11-11-2008', '13-11-2008'); // true
$booking->book('12-11-2008', '12-11-2008'); // false
$booking->book('10-11-2008', '12-11-2008'); // false
$booking->book('12-11-2008', '14-11-2008'); // false
$booking->book('10-11-2008', '11-11-2008'); // true
$booking->book('13-11-2008', '14-11-2008'); // true
 */

namespace App;

use Carbon\Carbon;

// BEGIN (write your solution here)
class Booking
{
    private $reservations = [];

    public function book(string $dateBegin, string $dateEnd)
    {
        $first = Carbon::createFromFormat('d-m-Y', $dateBegin);
        $second = Carbon::createFromFormat('d-m-Y', $dateEnd);
        if ($first > $second || $first == $second) {
            return false;
        }
        foreach ($this->reservations as $reserve) {
            [$begin, $end] = $reserve;
            $beginPeriod = Carbon::createFromFormat('d-m-Y', $begin);
            $endPeriod = Carbon::createFromFormat('d-m-Y', $end);
            if ($first->greaterThan($beginPeriod) && $first->lessThan($endPeriod) || $second->greaterThan($beginPeriod) && $second->lessThan($endPeriod) || $beginPeriod->between($first, $second) && $endPeriod->between($first, $second)) {
                return false;
            }
        }
        $this->reservations[] = [$dateBegin, $dateEnd];
        return true;
    }
}
// END

// BEGIN
class Booking
{
    private $dates = [];

    public function book($begin, $end)
    {
        $carbonNewBegin = new Carbon($begin);
        $carbonNewEnd = new Carbon($end);
        if ($this->canBook($carbonNewBegin, $carbonNewEnd)) {
            $this->dates[] = [$carbonNewBegin, $carbonNewEnd];
            return true;
        }

        return false;
    }

    public function canBook($begin, $end)
    {
        if ($begin >= $end) {
            return false;
        }

        foreach ($this->dates as [$bookedBegin, $bookedEnd]) {
            $isStartedAfter = $begin < $bookedEnd;
            $isEndedBefore = $end > $bookedBegin;
            if ($isStartedAfter && $isEndedBefore) {
                return false;
            }
        }
        return true;
    }
}
// END