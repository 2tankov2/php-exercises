<?php
// Реализуйте функцию checkIfBalanced, которая проверяет балансировку круглых скобок в арифметических выражениях.

namespace App\Strings;

// BEGIN (write your solution here)
function checkIfBalanced($expression)
{
    $stack = [];
    $hooks = '()';
    $hookOpen = '(';
    $hookClose = ')';
    for ($i = 0; $i < strlen($expression); $i++) {
        $curr = $expression[$i];
        if ($curr === $hookOpen) {
            array_push($stack, $curr);
        } if ($curr === $hookClose) {
            $prev = array_pop($stack);
            $pair = "{$prev}{$curr}";
            if ($pair !== $hooks) {
                return false;
            }
        };
    }
    return sizeof($stack) == 0;
}
// END

// BEGIN
function checkIfBalanced(string $expression): bool
{
    // инициализируем стек
    $stack = [];
    for ($i = 0, $length = strlen($expression); $i < $length; $i++) {
        $curr = $expression[$i];
        if ($curr == '(') {
            array_push($stack, $curr);
        } elseif ($curr == ')') {
            if (empty($stack)) {
                return false;
            }
            array_pop($stack);
        };
    }

    // Если стек оказался пустой после обхода строки, то значит все хорошо
    return count($stack) == 0;
}
// END