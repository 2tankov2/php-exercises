<?php
// Реализуйте функцию swap, которая меняет местами переданные аргументы по ссылке.
namespace App\Vars;

// BEGIN (write your solution here)
function swap(& $a, & $b)
{
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}
// END