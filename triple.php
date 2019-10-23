<?php

/**
 * Кроме пар можно создавать абстрактные типы данных, которые содержат внутри себя три и более элемента.

 * В данном испытании необходимо реализовать структуру данных тройка, позволяющую хранить три значения.
 * Как и в случае с парами создаётся конструктор make и селекторы get1, get2, get3, которые будут извлекать 
 * соответствующие значения.

src/triple.php
 * Реализуйте следующие функции:

make
get1
get2
get3
 * Пример
<?php

$triple = make(3, 5, 'I am element from triple');
get1($triple); // 3
get2($triple); // 5
get3($triple); // I am element from triple
 */

namespace App\triple;

// BEGIN (write your solution here)
function make($a, $b, $c)
{
    return function ($collback) use ($a, $b, $c) {
        return $collback($a, $b, $c);
    };
}

function get1($triple)
{
    return $triple(
        function ($a, $b, $c) {
            return $a;
        }
    );
}

function get2($triple)
{
    return $triple(
        function ($a, $b, $c) {
            return $b;
        }
    );
}

function get3($triple)
{
    return $triple(
        function ($a, $b, $c) {
            return $c;
        }
    );
}
// END

// BEGIN
function make($x, $y, $z)
{
    return function ($method) use ($x, $y, $z) {
        switch ($method) {
            case "get1":
                return $x;
            case "get2":
                return $y;
            case "get3":
                return $z;
            default:
                return false;
        }
    };
}

function get1($triple)
{
    return $triple("get1");
}

function get2($triple)
{
    return $triple("get2");
}

function get3($triple)
{
    return $triple("get3");
}
// END