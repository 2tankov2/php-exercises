<?php
// Реализуйте функцию isContinuousSequence, которая проверяет, является ли переданная последовательность целых чисел - возрастающей непрерывно (не имеющей пропусков чисел). Например, последовательность [4, 5, 6, 7] - непрерывная, а [0, 1, 3] - нет. 
// Последовательность может начинаться с любого числа, главное условие - отсутствие пропусков чисел.
namespace App\Arrays;

// BEGIN (write your solution here)
function isContinuousSequence($arr)
{
    if (count($arr) === 0) {
        return false;
    }
    foreach ($arr as $index => $name) {
        if ($index + 1 >= count($arr)) {
            return true;
        }
        if ($name !== $arr[$index + 1] - 1) {
            return false;
        }
    } return true;
}
// END

// BEGIN
function isContinuousSequence($coll)
{
    if (empty($coll)) {
        return false;
    }
    $start = $coll[0];
    foreach ($coll as $i => $item) {
        if ($start + $i !== $item) {
            return false;
        }
    }

    return true;
}
// END