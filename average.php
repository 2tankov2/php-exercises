<?php

// Реализуйте функцию average, которая возвращает среднее арифметическое всех переданных аргументов.
// Если функции не передать ни одного аргумента, то она должна вернуть null.

namespace App\Math;

// BEGIN (write your solution here)
function average(...$numbers)
{
    if (sizeof($numbers) === 0) {
        return null;
    } return array_sum($numbers) / sizeof($numbers);
}
// END

// BEGIN
function average(...$numbers)
{
    if (empty($numbers)) {
        return null;
    }

    return (array_sum($numbers)) / (count($numbers));
}
// END