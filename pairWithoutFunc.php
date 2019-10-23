<?php

/**
 * Пары неотрицательных целых чисел можно представить числами и арифметическими операциями. Можно считать, что пара
 * чисел a и b – это 2^a * 3^b.

 * Функции car и cdr при этом будут просто вычислять значения a и b (кратности двойки и тройки, соответственно),
 * раскладывая аргумент на множители.

 * Например, имея пару 5, 8 в виде числа 209952 (2^5 * 3^8), можно получить первый элемент пары, разложив число на
 * множители и вычислив факторизацию для числа 2, а второй элемент пары – разложив число на множители и вычислив
 * факторизацию для числа 3.

src/pairs.php
 * Реализуйте следующие функции в соответствии с алгоритмом выше:

cons
car
cdr
 * Пример
$pair = cons(5, 8); // 2^5 * 3^8 = 209952
car($pair); // 5
cdr($pair); // 8
 * Подсказки
 * Пара – это число, поэтому, чтобы получить из него исходные значения a и b, нужно раскладывать число на множители.
 */

namespace App\pairs;

// BEGIN (write your solution here)
function cons($a, $b)
{
    return 2 ** $a * 3 ** $b;
}

function car($num)
{
    if ($num === 1) {
        return 0;
    }
    $result = 0;
    while ($num % 2 === 0) {
        $num = $num / 2;
        $result += 1;
    }
    return $result;
}

function cdr($num)
{
    if ($num === 1) {
        return 0;
    }
    $result = 0;
    while ($num % 3 === 0) {
        $num = $num / 3;
        $result += 1;
    }
    return $result;
}
// END

// BEGIN
function factor($base, $value)
{
    if ($value % $base !== 0) {
        return 0;
    }

    return 1 + factor($base, $value / $base);
}

function cons($a, $b)
{
    return (2 ** $a) * (3 ** $b);
}

function car($pair)
{
    return factor(2, $pair);
}

function cdr($pair)
{
    return factor(3, $pair);
}
// END