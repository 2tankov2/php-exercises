<?php
// Реализуйте функцию getSameParity, которая принимает на вход массив чисел и возвращает новый,
// состоящий из элементов, у которых такая же чётность, как и у первого элемента входного массива.
namespace App\Arrays;

// BEGIN (write your solution here)
function getSameParity($numbers)
{
    $newNumbers = [];
    if (count($numbers) === 0) {
        return [];
    }
    foreach ($numbers as $value) {
        if ($numbers[0] % 2 === 0) {
            if ($value % 2 === 0) {
                $newNumbers[] = $value;
            }
        } elseif ($numbers[0] % 2 !== 0) {
            if ($value % 2 !== 0) {
                $newNumbers[] = $value;
            }
        }
    } return $newNumbers;
}
// END

// BEGIN
function getSameParity($coll)
{
    if (empty($coll)) {
        return [];
    }

    $result = [];
    $reminder = $coll[0] % 2;
    foreach ($coll as $item) {
        if ($item % 2 == $reminder) {
            $result[] = $item;
        }
    }

    return $result;
}
// END