<?php
// Реализуйте функцию isPowerOfThree которая определяет, является ли переданное число натуральной 
// степенью тройки. Например число 27 это третья степень (33), а 81 это четвертая (34).

namespace App\Solution;

// BEGIN (write your solution here)
function isPowerOfThree($num)
{
    switch ($num) {
        case 0:
            return false;
        case ($num / 3 === 0 || $num === 1):
            return true;
        case ($num < 3 && $num > 0):
            return false;
    } return isPowerOfThree($num / 3);
}
// END

// BEGIN
function isPowerOfThree(int $num)
{
    $current = 1;
    while ($current <= $num) {
        if ($current === $num) {
            return true;
        }
        $current *= 3;
    }

    return false;
}
// END