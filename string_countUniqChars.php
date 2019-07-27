<?php
/*
Реализуйте функцию countUniqChars, которая получает на вход строку и считает,
сколько символов (уникальных символов) использовано в этой строке. Например,
в строке 'yy' всего один уникальный символ — y. А в строке '111yya!' — четыре уникальных символа: 1, y, a и !.

Задание необходимо выполнить без использования функции array_unique.
*/
namespace App\Strings;

// BEGIN (write your solution here)
function countUniqChars($str)
{
    if (strlen($str) === 0) {
        return 0;
    }
    $result = 0;
    $arrChar = [];
    $chars = str_split(mb_strtolower($str));
    foreach ($chars as $index => $char) {
        if (!in_array($chars[$index], $arrChar)) {
            $arrChar[$index] = $chars[$index];
        }
    } return count($arrChar);
}
// END

// BEGIN
function countUniqChars($text)
{
    if ($text === '') {
        return 0;
    }

    $chars = str_split($text);
    $uniqChars = [];
    foreach ($chars as $char) {
        if (!in_array($char, $uniqChars)) {
            $uniqChars[] = $char;
        }
    }

    return count($uniqChars);
}
// END