<?php
/** 
Реализуйте функцию isBalanced, которая принимает на вход строку, состоящую только из открывающих и
закрывающих круглых скобок, и проверяет является ли эта строка корректной. Пустая строка (отсутствие скобок)
считается корректной.

Строка считается корректной (сбалансированной), если содержащаяся в ней скобочная структура соответствует
требованиям:

Скобки — это парные структуры. У каждой открывающей скобки должна быть соответствующая ей закрывающая скобка.
Закрывающая скобка не должна идти впереди открывающей. Такой вариант недопустим )(, а вот такой допустим ()().
*/
namespace App\Brackets;

// BEGIN (write your solution here)
function isBalanced($text)
{
    $len = strlen($text);
    if ($len === 0) {
        return true;
    }
    $hooks = '()';
    $hookOpen = '(';
    $hookClose = ')';
    $stack = [];
    for ($i = 0; $i < $len; $i++) {
        $curr = $text[$i];
        if ($curr === $hookOpen) {
            $stack[] = $curr;
        } else {
            $per = array_pop($stack);
            $pair = "{$per}{$curr}";
            if ($pair !== $hooks) {
                return false;
            }
        }
    } return count($stack) === 0;
}
// END

// BEGIN
function isBalanced($str)
{
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $count = $str[$i] === '(' ? $count + 1 : $count - 1;
        if ($count < 0) {
            return false;
        }
    }

    return $count === 0;
}
// END