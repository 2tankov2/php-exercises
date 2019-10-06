<?php

// Реализуйте функцию calcInPolishNotation, которая принимает массив, каждый элемент которого содержит число или знак операции (+, -, *, /). Функция должна вернуть результат вычисления по обратной польской записи.

// <?php

// calcInPolishNotation([1, 2, '+', 4, '*', 3, '+']);
// // → 15

// calcInPolishNotation([7, 2, 3, '*', '-']);
// // → 1

<?php
namespace App\Arrays;

// BEGIN (write your solution here)
function calculate($num1, $num2, $mathSign)
{
    switch ($mathSign) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2;
        case '/':
            return $num1 / $num2;
    }
}

function calcInPolishNotation($data)
{
    $matSigns = ['+', '-', '*', '/'];
    $stack = [];
    $size = count($data);
    for ($i = 0; $i < $size; $i++) {
        $curr = $data[$i];
        if (in_array($curr, $matSigns)) {
            $num2 = array_pop($stack);
            $num1 = array_pop($stack);
            $result = calculate($num1, $num2, $curr);
            array_push($stack, $result);
        } else {
            array_push($stack, $curr);
        }
    } return array_pop($stack);
}
// END

// BEGIN
function calcInPolishNotation(array $array)
{
    $stack = [];
    $operators = ['*', '/', '+', '-'];
    foreach ($array as $value) {
        if (!in_array($value, $operators)) {
            array_push($stack, $value);
            continue;
        }

        $b = array_pop($stack);
        $a = array_pop($stack);
        switch ($value) {
            case '*':
                $result = $a * $b;
                break;
            case '/':
                $result = $a / $b;
                break;
            case '+':
                $result = $a + $b;
                break;
            case '-':
                $result = $a - $b;
                break;
        }
        array_push($stack, $result);
    }

    return array_pop($stack);
}
// END