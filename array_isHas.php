<?php
// Реализуйте функцию get, которая излекает из массива элемент по указанному индексу, если индекс существует, либо возвращает значение по умолчанию. Функция принимает на вход три аргумента:

// Массив
// Индекс
// Значение по умолчанию (которое по умолчанию равно null)
namespace App\Arrays;

// BEGIN (write your solution here)
function get(array $arr, $index, $data = null)
{
    return $arr[$index] ?? $data;
}
// END

// BEGIN
function get(array $arr, $index, $default = null)
{
    if (!array_key_exists($index, $arr)) {
        return $default;
    }

    return $arr[$index];
}
// END