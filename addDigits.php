<?php
// Дано не отрицательное целое число num. Итеративно сложите все входящие в него цифры до тех пор пока не останется одна цифра.

namespace App\Solution;

// BEGIN (write your solution here)
function addDigits($num)
{
    if ($num < 10) {
        return $num;
    } else {
        $str = (string) $num;
        $result = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $result += $str[$i];
        }
    } return addDigits($result);
}
// END

// BEGIN
function sumDigits(int $number)
{
    $str = (string) $number;
    $result = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $result += (int) $str[$i];
    }
    return $result;
}

function addDigits($num)
{
    $result = $num;
    while ($result >= 10) {
        $result = sumDigits($result);
    }

    return $result;
}
// END