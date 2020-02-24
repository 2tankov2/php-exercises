<?php

/**
 * Для записи цифр римляне использовали буквы латинского алфафита: I, V, X, L, C, D, M. Например:

 * 1 обозначалась с помощью буквы I
 * 10 с помощью Х
 * 7 с помощью VII
 * Число 2020 в римской записи — это MMXX (2000 = MM, 20 = XX).

src/Solution.php
 * Реализуйте функцию toRoman, которая переводит арабские числа в римские. Функция принимает число и 
 * возвращает строку с римским представлением этого числа. Максимальное значение, которое принимает
 * функция — 3000.

Примеры
<?php

use function App\Solution\toRoman;

toRoman(1);
// 'I'
toRoman(59);
// 'LIX'
toRoman(3000);
// 'MMM'
 */

// src/solution.php


namespace App\Solution;

// BEGIN (write your solution here)
const ROMANNUMBERS = [
    'M' => 1000,
    'CM' => 900,
    'D' => 500,
    'CD' => 400,
    'C' => 100,
    'XC' => 90,
    'L' => 50,
    'XL' => 40,
    'X' => 10,
    'IX' => 9,
    'V' => 5,
    'IV' => 4,
    'I' => 1
];

function balance($num, $romanNum = '')
{
    foreach (ROMANNUMBERS as $key => $value) {
        $res = $num - $value;
        if ($res >= 0) {
            $romanNum .= $key;
            return [$res, $romanNum];
        }
    }
}
function toRoman($num)
{
    [$balance, $romanNum] = balance($num);

    if ($balance === 0) {
        return $romanNum;
    } else {
        return $romanNum .= toRoman($balance);
    }
}
// END

//BEGIN
function toRoman($number)
{
    $digit = $number;
    $result = '';
    foreach (NUMERALS as $roman => $arabic) {
        $repetitionsCount = floor($digit / $arabic);
        $digit -= $repetitionsCount * $arabic;
        $result .= str_repeat($roman, $repetitionsCount);
    }

    return $result;
}
// END