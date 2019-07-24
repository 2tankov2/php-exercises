<?php
// Создайте функцию isPerfect, которая принимает число и возвращает true, если оно совершенное, и false — в ином случае.
// Совершенное число — это положительное целое число, равное сумме его положительных делителей (не считая само число).
// Например, 6 — совершенное число, потому что 6 = 1 + 2 + 3.
namespace App\Numbers;

// BEGIN (write your solution here)
function isPerfect($num)
{
    $result = 1;
    $i  = $num - 1;
    if ($num <= 0) {
        return false;
    }
    if ($num < 2) {
        return true;
    }
    while ($i > 1) {
        if ($num % $i === 0) {
            $result += $i;
        } $i--;
    } return $num === $result;
}
// END

// BEGIN
function isPerfect($num)
{
    if ($num === 0) {
        return false;
    }

    $upperBorder = $num / 2;
    $sum = 0;
    for ($divisor = 1; $divisor <= $upperBorder; $divisor++) {
        if ($num % $divisor === 0) {
            $sum += $divisor;
        }
    }
    return $sum === $num;
}
// END