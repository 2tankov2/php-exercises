<?php
/**
 * Чанкованием (от англ. Chunk — ячейка, кусок, осколок) в программировании называют разбиение коллекции (массива) 
 * на несколько более мелких коллекций. Например, разобьём массив на чанки, так чтобы в каждом чанке было не более 
 * двух элементов: ['a', 'b', 'c', 'd'] -> [['a', 'b'], ['c', 'd']].

 * Реализуйте функцию getChunked, которая принимает на вход массив и число, задающее размер чанка (куска). Функция
 * должна вернуть массив, состоящий из чанков указанной размерности.

<?php

getChunked(['a', 'b', 'c', 'd'], 2);
// → [['a', 'b'], ['c', 'd']]

getChunked(['a', 'b', 'c', 'd'], 3);
// → [['a', 'b', 'c'], ['d']]
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function getChunked($data, $num)
{
    $size = sizeof($data);
    if ($size < 0) {
        return [];
    }
    $result = [];
    $i = 0;
    foreach ($data as $key => $value) {
        $result[$i][] = $data[$key];
        if (($key + 1) % $num === 0) {
            $i++;
        }
    } return $result;
}
// END

// BEGIN
function getChunked(array $array, int $size)
{
    $result = [];
    for ($i = 0, $length = count($array); $i < $length; $i += $size) {
        $result[] = array_slice($array, $i, $size);
    }

    return $result;
}
// END