<?php
// Реализуйте функцию swap, которая меняет местами два элемента относительно переданного индекса. Например, если передан индекс 5, то функция меняет местами элементы, находящиеся по индексам 4 и 6.

// Параметры функции:

// Массив
// Индекс
// Если хотя бы одного из индексов не существует, функция возвращает исходный массив.
namespace App\Arrays;

// BEGIN (write your solution here)
function swap($arr, $index)
{
    $indexLeft = $index - 1;
    $indexRight = $index + 1;
    if (!isset($arr[$indexLeft]) || !isset($arr[$indexRight])) {
        return $arr;
    }
    $temp = $arr[$indexLeft];
    $arr[$indexLeft] = $arr[$indexRight];
    $arr[$indexRight] = $temp;
    return $arr;
}
// END
// BEGIN
function swap($coll, $center)
{
    $prevIndex = $center - 1;
    $nextIndex = $center + 1;
    $isSwappable = array_key_exists($prevIndex, $coll) && array_key_exists($nextIndex, $coll);

    if ($isSwappable) {
        $temp = $coll[$prevIndex];
        $coll[$prevIndex] = $coll[$nextIndex];
        $coll[$nextIndex] = $temp;
    }

    return $coll;
}
// END