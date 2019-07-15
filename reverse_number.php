<?php
// Реализуйте функцию reverse, которая переворачивает цифры в переданном числе
namespace App\Number;

// BEGIN (write your solution here)
function reverse(int $num): int
{
    $modNum = abs($num);
    $str = "{$modNum}";
    $result = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $result = $str[$i] . $result;
    } return ($num < 0) ? '-' . $result : $result;
}
// END
// BEGIN
function reverse(int $num): int
{
    $reverse = (int) strrev((string) abs($num));
    return $num > 0 ? $reverse : -$reverse;
}
// END