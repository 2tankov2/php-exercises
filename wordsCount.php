<?php
/**
 * Реализуйте функцию wordsCount, которая считает количество одинаковых слов в предложении. Результатом
 *  функции является ассоциативный массив, в ключах которого слова из исходного текста, а значения это
 * количество повторений.

Пример:

<?php

wordsCount(''); // []
wordsCount('  one two one'); // ['one' => 2, 'two' => 1]
wordsCount('  one      two       one     '); // ['one' => 2, 'two' => 1]
 */
namespace App\Solution;

// BEGIN (write your solution here)
function wordsCount($text)
{
    if (empty($text)) {
        return [];
    }
    $result = [];
    $trimmed = trim($text);
    $arr = explode(' ', $trimmed);
    $newArray = array_diff($arr, array(''));
    foreach ($newArray as $value) {
        if (array_key_exists($value, $result)) {
            $result[$value]++;
        } else {
            $result[$value] = 1;
        }
    } return $result;
}
// END

// BEGIN
function wordsCount($sentence)
{
    $words = explode(" ", $sentence);
    $result = [];
    foreach ($words as $word) {
        if (empty($word)) {
            continue;
        }
        if (!array_key_exists($word, $result)) {
            $result[$word] = 1;
        } else {
            $result[$word]++;
        }
    }

    return $result;
}
// END