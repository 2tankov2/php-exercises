<?php

/**
 * pairs.php
 * Напишите функции car и cdr, основываясь на реализации функции cons:

function cons($a, $b)
{
    return function ($callback) use ($a, $b)
    {
        return $callback($a, $b);
    };
}
 * При таком определении как выше, пара будет представлять из себя анонимную функцию. Например:

$pair = cons(5, 3);
/*
Closure Object
(
    [static] => Array
        (
            [a] => 5
            [b] => 3
        )

    [parameter] => Array
        (
            [$callback] => <required>
        )

)

 * Теперь догадаться до решения не так уж и сложно. По сути car и cdr должны вызвать внутри себя pair
 * (ведь это функция, не забыли?), и передать туда функцию, которая в зависимости от ситуации вернет либо первый,
 * либо второй аргумент.
 */


namespace App\pairs;

function cons($first, $second)
{
    return function ($callback) use ($first, $second) {
        return $callback($first, $second);
    };
}

// BEGIN (write your solution here)
function car(callable $pair)
{
    return $pair(
        function ($first, $second) {
            return $first;
        }
    );
}

function cdr(callable $pair)
{
    return $pair(
        function ($first, $second) {
            return $second;
        }
    );
}
// END

//BEGIN
function cons($a, $b)
{
  return function ($message) use ($a, $b) {
    switch ($message) {
      case 'car':
        return $a;
      case 'cdr':
        return $b;
    }
  };
}

function car($pair)
{
  return $pair('car');
}

function cdr($pair)
{
  return $pair('cdr');
}
//END