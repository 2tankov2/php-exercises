<?php
// Реализуйте функцию addPrefix, которая добавляет к каждому элементу массива переданный префикс и возвращает получившийся массив. Функция предназначена для работы со строковыми элементами. Аргументы:

// Массив
// Префикс
// После префикса автоматически добавляется пробел.
namespace App\Arrays;

// BEGIN (write your solution here)
function addPrefix($arr, $str)
{
    $length = count($arr);
    for ($i = 0; $i < $length; $i++) {
        $arr[$i] = $str . ' ' . $arr[$i];
    } return $arr;
}
// END
// BEGIN
function addPrefix($names, $prefix)
{
    $result = [];
    for ($i = 0, $length = count($names); $i < $length; $i++) {
        $result[$i] = "{$prefix} {$names[$i]}";
    }

    return $result;
}
// END