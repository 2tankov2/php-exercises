<?php
// Реализуйте функцию calculateAverage, которая высчитывает среднее арифметическое элементов массива. 
// Благодаря этой функции мы наконец-то посчитаем среднюю температуру по больнице :)
// В случае пустого массива функция должна вернуть значение null (используйте в коде для этого guard expression):

namespace App\Arrays;

// BEGIN (write your solution here)
function calculateAverage($temperatures)
{
    $sum = 0;
    if (count($temperatures) === 0) {
        return null;
    }
    foreach ($temperatures as $value) {
        $sum += $value;
    }
    return round($sum / count($temperatures), 1);
}
// END

// BEGIN
function calculateAverage($coll)
{
    if (empty($coll)) {
        return null;
    }

    $sum = 0;
    foreach ($coll as $item) {
        $sum += $item;
    }

    return $sum / count($coll);
}
// END