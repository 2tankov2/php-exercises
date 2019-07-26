<?php
/*Имеется набор данных, описывающих изменение температуры воздуха в одном городе в течение нескольких суток.
Данные представлены массивом, в котором каждый элемент - это массив, содержащий список температур в течение
одних суток.

Допустим, у нас есть статистика температур (например, по состоянию на утро, день и вечер) за три дня.
Для первого дня значения температур составляют: -5°, 7°, 1°; для второго дня: 3°, 2°, 3°;
и для третьего дня: -1°, -1°, 10° . Массив, отражающий такую статистику, будет выглядеть так:

$data = [
    [-5, 7, 1],
    [3, 2, 3],
    [-1, -1, 10],
]
*/
namespace App\Arrays;

// BEGIN (write your solution here)
function getIndexOfWarmestDay($arr)
{
    $result;
    $maxElRow = [];
    $indexMax = 0;
    if (count($arr) === 0) {
        return null;
    }
    foreach ($arr as $index => $row) {
        foreach ($row as $value) {
            $maxElement = max($row);
        } $maxElRow[] = $maxElement;
    } var_dump($maxElRow);
    $result = max($maxElRow);
    $indexMax = array_search($result, $maxElRow);
    return $indexMax;
}
// END

// BEGIN
function getIndexOfWarmestDay(array $data)
{
    $index = null;
    $max = PHP_INT_MIN;
    foreach ($data as $key => $temperatures) {
        foreach ($temperatures as $value) {
            if ($value > $max) {
                $index = $key;
                $max = $value;
            }
        }
    }

    return $index;
}
// END