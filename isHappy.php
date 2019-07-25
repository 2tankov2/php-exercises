<?php

// Реализуйте функцию isHappy, проверяющую является ли номер счастливым (номер всегда строка). Функция должна возвращать true, если билет счастливый, или false, если нет. Номера могут быть произвольной длины, с единственным условием что количество цифр всегда четно, например, 33 или 2341 и так далее.
// Например, билет с номером 385916 - счастливый, так как 3 + 8 + 5 = 9 + 1 + 6

namespace App\Ticket;

// BEGIN (write your solution here)
function isHappy($str)
{
    $result1 = 0;
    $result2 = 0;
    $lengthHalf = strlen($str) / 2;
    $lengthAll = strlen($str);
    for ($i = 0, $j = $lengthAll - 1; $i < $lengthHalf; $i++, $j--) {
        $result1 += $str[$i];
        $result2 += $str[$j];
    } return $result1 === $result2;
}
// END

// BEGIN
function isHappy ($str)
{
    $balance = 0;
    for ($i = 0, $j = strlen($str) - 1; $i < $j; $i += 1, $j -= 1) {
        $balance += $str[$i] - $str[$j];
    }
    return $balance === 0;
}
// END