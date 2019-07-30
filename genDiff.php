<?php
/**
 * Реализуйте функцию genDiff, которая возвращает ассоциативный массив, в котором каждому ключу из исходных
 * массивов соответствует одно из четырёх значений: added, deleted, changed или unchanged. Аргументы:

* Ассоциативный массив
* Ассоциативный массив
* Расшифровка:

added — ключ отсутствовал в первом массиве, но был добавлен во второй
deleted — ключ был в первом массиве, но отсутствует во втором
changed — ключ присутствовал и в первом и во втором массиве, но значения отличаются
unchanged — ключ присутствовал и в первом и во втором массиве с одинаковыми значениями
*/

namespace App\Arrays;

function union(array $data1, array $data2)
{
    return array_unique(array_merge($data1, $data2));
}

// BEGIN (write your solution here)
function genDiff($data1, $data2)
{
    $newArr = union($data1, $data2);
    foreach ($newArr as $key => $value) {
        if (array_key_exists($key, $data1)) {
            if (array_key_exists($key, $data2)) {
                if ($data1[$key] === $data2[$key]) {
                    $newArr[$key] = 'unchanged';
                } else {
                    $newArr[$key] = 'changed';
                }
            } else {
                $newArr[$key] = 'deleted';
            }
        } else {
            $newArr[$key] = 'added';
        }
    } return $newArr;
}
// END

// BEGIN
function genDiff(array $data1, array $data2)
{
    $keys = union(array_keys($data1), array_keys($data2));
    $result = [];
    foreach ($keys as $key) {
        if (!array_key_exists($key, $data1)) {
            $result[$key] = 'added';
        } elseif (!array_key_exists($key, $data2)) {
            $result[$key] = 'deleted';
        } elseif ($data1[$key] !== $data2[$key]) {
            $result[$key] = 'changed';
        } elseif ($data1[$key] === $data2[$key]) {
            $result[$key] = 'unchanged';
        }
    }

    return $result;
}
// END