<?php
// Реализуйте функцию binarySum, которая принимает на вход два бинарных числа (в виде строк) и возвращает их сумму. 

namespace App\Solution;

// BEGIN (write your solution here)
function binarySum($num1, $num2)
{
    $DecNum1 = bindec($num1);
    $DecNum2 = bindec($num2);
    $sum = $DecNum1 + $DecNum2;
    return decbin($sum);
}
// END

// BEGIN
function binarySum($first, $second)
{
    return decbin((bindec($first) + bindec($second)));
}
// END