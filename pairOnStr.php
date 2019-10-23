<?php

/**
 * Пару можно создать на основе строки. Для хранения двух значений применим разделитель. Им может выступить любой символ,
 * однако во избежание совпадений с исходными данными лучше взять редко используемое значение.

 * Для этого подойдёт так называемая управляющая или escape-последовательность, которая начинается с обратной косой черты.
 * Мы будем использовать специальный символ \0, обозначающий нулевой символ (NUL).

 * Функции car и cdr должны получить содержимое строки до и после разделителя соответственно.

 * Управляющая последовательность воспринимается интерпретатором как одиночный символ, то есть имеет длину, равную 1.

 * Обязательным условием является отсутствие данного символа в строках, которые объединяются в пару.

src/pairs.php
 * В соответствии с алгоритмом выше реализуйте функции:

cons
car
cdr
 * Пример
$pair = cons('computer', 'science'); // 'computer\0science'
car($pair); // 'computer'
cdr($pair); // 'science'
 * Подсказки
 * Для подсчёта длины строки используйте функцию getLength() из файла length.php.
 */

namespace App\pairs;

use function App\length\getLength;

// BEGIN (write your solution here)
function cons($str1, $str2)
{
    $sing = '\0';
    return $str1 . $sing . $str2;
}

function car($pair)
{
    [$a, $b] = explode('\0', $pair);
    return $a;
}

function cdr($pair)
{
    [$a, $b] = explode('\0', $pair);
    return $b;
}
// END

// BEGIN
const SEPARATOR = "\0";

function getSeparatorPosition($str)
{
    $iter = function ($i) use (&$iter, $str) {

        if ($str[$i] == SEPARATOR) {
            return $i;
        }

        return $iter($i + 1);
    };

    return $iter(0);
}

function getValue($pair, $begin, $end)
{
    $iter = function ($acc, $i) use (&$iter, $pair, $end) {
        if ($i >= $end) {
            return $acc;
        }

        $part = $pair[$i];
        $newAcc = "{$acc}{$part}";

        return $iter($newAcc, $i + 1);
    };

    return $iter('', $begin);
}

function cons($a, $b)
{
    $sep = SEPARATOR;
    $str = "{$a}{$sep}{$b}";

    return $str;
}

function car($pair)
{
    return getValue($pair, 0, getSeparatorPosition($pair));
}

function cdr($pair)
{
    return getValue($pair, getSeparatorPosition($pair) + 1, getLength($pair));
}
// END