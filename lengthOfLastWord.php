<?php
// Реализуйте функцию lengthOfLastWord,
// которая возвращает длину последнего слова переданной на вход строки.
// Словом считается любая последовательность, не содержащая пробелов.
namespace App\Solution;

// BEGIN (write your solution here)
function lengthOfLastWord($text)
{
    if ($text === '') {
        return 0;
    }
    $words = explode(' ', $text);
    $result = end($words);
    if (!$result === '') {
        return strlen($result);
    } while (count($words) > 0) {
        $element = array_pop($words);
        if (strlen($element) > 0) {
            $result = $element;
            break;
        }
    } return strlen($result);
};
// END

// BEGIN
function lengthOfLastWord(String $str)
{
    $words = explode(' ', trim($str));
    return strlen($words[count($words) - 1]);
}
// END