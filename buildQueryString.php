<?php
/**
 * Query String (строка запроса) — часть адреса страницы в интернете содержащая константы и их значения.
 * Она начинается после вопросительного знака и идет до конца адреса. Пример:

# query string: page=5
https://ru.hexlet.io/blog?page=5
 * Если параметров несколько, то они отделяются амперсандом &:

# query string: page=5&per=10
https://ru.hexlet.io/blog?per=10&page=5
src\AssociativeArrays.php
 * Реализуйте функцию buildQueryString, которая принимает на вход список параметров и возвращает сформированный
 * query string из этих параметров:

<?php

buildQueryString(['per' => 10, 'page' => 1 ]);
// → page=1&per=10
 * Имена параметров в выходной строке должны располагаться в алфавитном порядке
 */
namespace App\AssociativeArrays;

// BEGIN (write your solution here)
function buildQueryString($data)
{
    uksort($data, function ($a, $b) {
        return strcmp($a, $b);
    });
    $result = [];
    foreach ($data as $key => $value) {
        $result[] = implode('=', [$key, $value]);
    }
    return implode('&', $result);
}
// END

// BEGIN
function buildQueryString(Array $array)
{
    ksort($array);
    $result = [];
    foreach($array as $key => $value) {
        $result[] = "{$key}={$value}";
    }

    return implode('&', $result);
}
// END