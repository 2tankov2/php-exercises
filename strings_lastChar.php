<?php
// Реализуйте анонимную функцию, которая принимает на вход строку и возвращает её последний символ
// (или null, если строка пустая). Запишите созданную функцию в переменную $last.

namespace App\Strings;

function run(string $text)
{
    // BEGIN (write your solution here)
    $last = function ($text) {
        $len = strlen($text);
        if ($len === 0) {
            return null;
        } return $text[$len - 1];
    };
    // END

    return $last($text);
}

// BEGIN
$last = function (string $text) {
    if ($text === '') {
        return null;
    }
    return $text[strlen($text) - 1];
};
// END