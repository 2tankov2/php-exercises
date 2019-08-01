<?php
/**
 * Реализуйте функцию getMirrorMatrix, которая принимает двумерный массив (матрицу) и возвращает массив,
 * изменённый таким образом, что правая половина матрицы становится зеркальной копией левой половины,
 * симметричной относительно вертикальной оси матрицы. Для простоты условимся, что матрица всегда имеет
 * чётное количество столбцов и количество столбцов всегда равно количеству строк.

<?php

getMirrorMatrix([
  [11, 12, 13, 14],
  [21, 22, 23, 24],
  [31, 32, 33, 34],
  [41, 42, 43, 44],
]);

// → [
//     [11, 12, 12, 11],
//     [21, 22, 22, 21],
//     [31, 32, 32, 31],
//     [41, 42, 42, 41],
//   ]
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function getMirrorMatrix($data)
{
    foreach ($data as $key => $row) {
        for ($i = 0, $j = count($row) - 1; $i < count($row) / 2; $i++, $j--) {
            $row[$j] = $row[$i];
        } $data[$key] = $row;
    } return $data;
}
// END

// BEGIN
function getMirrorMatrix(array $array)
{
    $size = count($array);
    $mirrorArray = [];
    for ($i = 0; $i < $size; $i += 1) {
        for ($j = 0; $j < $size / 2; $j += 1) {
            $mirrorArray[$i][$j] = $array[$i][$j];
            $mirrorArray[$i][$size - $j - 1] = $array[$i][$j];
        }
    }

    return $mirrorArray;
}
// END