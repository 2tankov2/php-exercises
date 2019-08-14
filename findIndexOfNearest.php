<?php
/**
 * Реализуйте функцию findIndexOfNearest, которая принимает на вход массив чисел и искомое число.
 * Задача функции — найти в массиве ближайшее число к искомому и вернуть его индекс в массиве.

 * Если в массиве содержится несколько чисел, одновременно являющихся ближайшими к искомому числу,
 * то возвращается наименьший из индексов ближайших чисел.

 * Примеры

findIndexOfNearest([], 2); // => null
findIndexOfNearest([15, 10, 3, 4], 0); // => 2
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function findIndexOfNearest($numbers, $check)
{
    if ($numbers === []) {
        return null;
    }
    $result = array_reduce($numbers, function ($acc, $value) use ($check) {
        return abs($check - $value) < abs($acc - $check) ? $value : $acc;
    }, $numbers[0]);
    $key = array_search($result, $numbers);
    return $key;
}
// END

// BEGIN
function findIndexOfNearest(array $items, $value)
{
    if (empty($items)) {
        return null;
    }
    return array_reduce(array_keys($items), function ($acc, $i) use ($items, $value) {
        return abs($items[$i] - $value) < abs($items[$acc] - $value) ? $i : $acc;
    }, 0);
}
// END