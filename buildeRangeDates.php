<?php

/**
 * src/Dates.php
 * Реализуйте функцию buildRange, которая переводит входные данные в удобный для построения графика формат.

 * На вход эта функция принимает массив данных. Каждая запись массива представляет из себя объект
 * типа [ 'value' => 14, 'date' => '02.08.2018' ]. Например:

<?php

$data = [
  [ 'value' => 14, 'date' => '02.08.2018' ],
  [ 'value' => 43, 'date' => '03.08.2018' ],
  [ 'value' => 38, 'date' => '05.08.2018' ],
];
 * Вторым и третьим параметрами функция принимает даты (в форме строк типа 'YYYY-MM-DD') начала и конца периода:

<?php

$begin = '2018-08-01';
$end = '2018-08-06';
 * Диапазон дат задаёт размер выходного массива, который должна сгенерить реализуемая функция. Правила формирования
 * итогового массива:

 * он заполняется записями по всем дням из диапазона begin - end
 * в него включаются только те записи из входного массива, даты которых попадают в диапазон
 * если во входном массиве нет данных для какого-то дня из диапазона, то в свойство value записи этого дня
 * установить значение 0
<?php

$result = buildRange(data, beginDate, endDate);
// OUTPUT
// [ [ 'value' => 0, 'date' => '01.08.2018' ],
//   [ 'value' => 14, 'date' => '02.08.2018' ],
//   [ 'value' => 43, date => '03.08.2018' ],
//   [ 'value' => 0, 'date' => '04.08.2018' ],
//   [ 'value' => 38, 'date' => '05.08.2018' ],
//   [ 'value' => 0, 'date' => '06.08.2018' ] ]
 * Подсказки
 * Функции из библиотеки Collect, которые могут пригодиться: keyBy.
 * Функции из библиотеки Carbon, которые могут пригодиться: \Carbon\CarbonPeriod::create.
 */

namespace App\Dates;

// BEGIN (write your solution here)
function buildRange(array $data, string $beginDate, string $endDate) {
    
    $period = \Carbon\CarbonPeriod::create($beginDate, $endDate);
    
    $dates = [];
    $coll = collect($data);
    
    foreach ($period as $key => $date) {
        $curdate = $date->format('d.m.Y');

        if ($coll->contains(function ($value, $key) use ($curdate) {
            return $value['date'] === $curdate;
            })) {
            $dates[$key] = $coll->firstWhere('date', '=', $curdate);
         
        } else {
            $dates[$key] = ['value' => 0, 'date' => $curdate];
        }     
    }   
    return $dates;

}
// END

// BEGIN
function buildRange($dates, $begin, $end)
{
    $datesByDate = collect($dates)->keyBy('date');
    $period = \Carbon\CarbonPeriod::create($begin, $end);
    $periodAsColl = collect($period->toArray());
    $resultAsColl = $periodAsColl->map(function ($day) use ($datesByDate) {
        $date = $day->format('d.m.Y');
        return $datesByDate[$date] ?? [ 'date' => $date, 'value' => 0 ];
    });
    return $resultAsColl->toArray();
}
// END
