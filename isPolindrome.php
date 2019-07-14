<?php
// Палиндром — число, слово или текст, одинаково читающееся в обоих направлениях. Например: "радар", "топот".
namespace App\Text;

// BEGIN (write your solution here)
function isPalindrome($text)
{
    if (strlen($text) < 2) {
        return true;
    }
    $half = (ceil(strlen($text) / 2));
    $i = 0;
    $j = strlen($text) - 1;
    
    for ($i; $i < $half; $i++) {
        $currentChar = $text[$i];
        $lastChar = $text[$j];
        if ($currentChar !== $lastChar) {
            return false;
        }
        $j--;
    }
    return true;
}
// END
// BEGIN (write your solution here)
function isPalindrome($text)
{
    if (strlen($text) < 2) {
        return true;
    }
    $firstChar = substr($text, 0, 1);
    $lastChar = substr($text, strlen($text) - 1, 1);
    if ($firstChar !== $lastChar) {
            return false;
    }
    return isPalindrome(substr($text, 1, strlen($text) - 2));
}
// END
// BEGIN
function isPalindrome(string $word)
{
    $lastIndex = strlen($word) - 1;
    for ($i = 0; $i < ceil($lastIndex / 2); $i++) {
        if ($word[$i] !== $word[$lastIndex - $i]) {
            return false;
        }
    }
    return true;
}
// END