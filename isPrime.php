<?php
// Реализуйте функцию sayPrimeOrNot, которая проверяет переданное число на простоту и печатает на экран yes или no.
namespace App\Prime;

// BEGIN (write your solution here)
function isPrime($num)
{
    if ($num < 2) {
        return false;
    } for ($i = 2; $i < $num; $i++) {
        if ($num % $i === 0) {
            return false;
        }
    } return true;
}

function sayPrimeOrNot($num)
{
    if (isPrime($num)) {
        return print_r('yes');
    } return print_r('no');
}
// END

// BEGIN
function isPrime(int $num)
{
    if ($num < 2) {
        return false;
    }

    for ($i = 2; $i <= $num / 2; $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }

    return true;
}

function sayPrimeOrNot($num)
{
    $text = isPrime($num) ? 'yes' : 'no';
    print_r($text);
}
// END