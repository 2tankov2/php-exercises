<?php

/**
 * src/Solution.php
 * Реализуйте функцию scrabble, которая принимает на вход два параметра: набор символов (строку) и слово,
 * и проверяет, можно ли из переданного набора составить это слово. В результате вызова функция возвращает
 * true или false.

 * При проверке учитывается количество символов, нужных для составления слова, и не учитывается их регистр.

 * Примеры
<?php

use function App\Solution\scrabble;

scrabble('rkqodlw', 'world'); 
// true
scrabble('avj', 'java'); 
// false
scrabble('avjafff', 'java'); 
// true
scrabble('', 'hexlet'); 
// false
scrabble('scriptingjava', 'JavaScript'); 
// tru
 */

// src/solution.php

namespace App\Solution;

// BEGIN (write your solution here)
function scrabble($charSet, $word)
{
    $chars = str_split(strtolower($charSet));
    $charsWord = str_split(strtolower($word));
    foreach ($charsWord as $key => $char) {
        if (!in_array($char, $chars)) {
            return false;
        }
        unset($chars[array_search($char, $chars)]);
    }
    return true;
}
// END

// BEGIN
function countByChars($str)
{
    $symbols = str_split($str);
    return array_count_values($symbols);
}

function scrabble($str, $word)
{
    $charsStr = countByChars($str);
    $charsWord = countByChars(mb_strtolower($word));
    foreach ($charsWord as $char => $count) {
        if (!array_key_exists($char, $charsStr)) {
            return false;
        }
        if ($charsStr[$char] < $count) {
            return false;
        }
    }
    return true;
}
// END