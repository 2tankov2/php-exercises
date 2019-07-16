<?php
/*
Реализуйте функцию fizzBuzz, которая выводит на экран числа в диапазоне от $begin до $end. При этом:

Если число делится без остатка на 3, то вместо него выводится слово Fizz
Если число делится без остатка на 5, то вместо него выводится слово Buzz
Если число делится без остатка и на 3, и на 5, то вместо числа выводится слово FizzBuzz
В остальных случаях выводится само число
Функция принимает два параметра ($begin и $end), определяющих начало и конец диапазона (включительно).
Если диапазон пуст (в случае, когда $begin > $end), то функция просто ничего не печатает.
*/
namespace App\Solution;

// BEGIN (write your solution here)
function fizzBuzz($begin, $end)
{
    for ($begin; $begin <= $end; $begin++) {
        if ($begin % 3 === 0) {
            print_r('Fizz');
            if ($begin % 5 === 0) {
                print_r('Buzz');
            } print_r(' ');
        } elseif ($begin % 5 === 0) {
            print_r('Buzz ');
        } else print_r("{$begin} ");
    }
}
// END
// BEGIN
function fizzBuzz($begin, $end)
{
    for ($i = $begin; $i <= $end; $i++) {
        $hasFizz = $i % 3 === 0;
        $hasBuzz = $i % 5 === 0;
        $fizzPart = $hasFizz ? 'Fizz' : '';
        $buzzPart = $hasBuzz ? 'Buzz' : '';
        print_r($hasFizz || $hasBuzz ? "{$fizzPart}{$buzzPart}" : $i);
        print_r(" ");
    }
}
// END