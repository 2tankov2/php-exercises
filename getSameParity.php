<?php
/**
 * Реализуйте функцию getSameParity, которая принимает на вход список и возвращает новый, состоящий из
 * элементов, у которых такая же четность, как и у первого элемента входного списка.

<?php

getSameParity([]); // => []
getSameParity([-1, 0, 1, -3, 10, -2]); // => [-1, 1, -3]
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function getSameParity($data)
{
    if (empty($data)) {
        return [];
    }
    $first = $data[0] % 2;
    $filtered = array_filter($data, function ($value) use ($first) {
        return abs($value) % 2 === abs($first);
    });
    return array_values($filtered);
}
// END

// BEGIN
function getSameParity(array $numbers)
{
    if (empty($numbers)) {
        return $numbers;
    }

    [$firstNum] = $numbers;
    $parity = abs($firstNum) % 2;
    $filtered = array_filter($numbers, function ($num) use ($parity) {
        return (abs($num) % 2) === $parity;
    });

    return array_values($filtered);
}
// END