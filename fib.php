<?php
/*
Реализуйте функцию fib находящую положительные числа Фибоначчи. Аргументом функции является порядковый номер числа.

Формула:

f(0) = 0
f(1) = 1
f(n) = f(n-1) + f(n-2)
*/

namespace App\Solution;

// BEGIN (write your solution here)
function fib($num)
{
    if ($num === 0 || $num === 1) {
        return $num;
    } return fib($num - 1) + fib($num - 2);
}
// END

// BEGIN
function fib($num)
{
    $fibSum = 0;
    $fib1 = 0;
    $fib2 = 1;

    for ($i = 0; $i < $num; $i++) {
        $fib1 = $fib2;
        $fib2 = $fibSum;
        $fibSum = $fib2 + $fib1;
    }

    return $fibSum;
}
// END