<?php
// Вес Хэмминга это количество единиц в двоичном представлении числа.
//Реализуйте функцию hammingWeight, которая считает вес Хэмминга.

namespace App\Solution;

// BEGIN (write your solution here)
function hammingWeight($num)
{
    $binNum = decbin($num);
    $data = str_split($binNum);
    $result = 0;
    foreach ($data as $value) {
        $result += $value;
    } return $result;
}
// END

// BEGIN
function hammingWeight(Int $num)
{
    $weight = 0;
    $digits = str_split(decbin($num));
    foreach ($digits as $value) {
        if ($value === '1') {
            $weight += 1;
        }
    }

    return $weight;
}
// END