<?php
// Реализуйте функцию findIndex, которая возвращает первый встретившийся индекс переданного элемента в случае, если элемент присутствует в массиве, и -1 в случае, если он отсутствует.

// Параметры функции:

// Массив
// Элемент
namespace App\Arrays;

// BEGIN (write your solution here)
function findIndex($arr, $element)
{
    foreach ($arr as $index => $value) {
        if ($value !== $element) {
            continue;
        } return $index;
    } return -1;
}
// END

// BEGIN
function findIndex($coll, $element)
{
    foreach ($coll as $key => $item) {
        if ($element == $item) {
            return $key;
        }
    }

    return -1;
}
// END