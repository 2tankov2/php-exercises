<?php

// Треугольник Паскаля — бесконечная таблица биномиальных коэффициентов, имеющая треугольную форму. В этом треугольнике на вершине и по бокам стоят единицы. Каждое число равно сумме двух расположенных над ним чисел. Строки треугольника симметричны относительно вертикальной оси.

// 0:      1
// 1:     1 1
// 2:    1 2 1
// 3:   1 3 3 1
// 4:  1 4 6 4 1
// src/Solution.php
// Напишите функцию generate, которая возвращает указанную строку треугольника паскаля в виде массива

// Пример:

// <?php

// generate(1); // → [1, 1]
// generate(4); // → [1, 4, 6, 4, 1]


namespace App\Solution;

function fact($num)
{
    if ($num === 0) {
        return 1;
    }
    return $num * fact($num - 1);
}

function generate(int $rowNumber)
{
    // BEGIN (write your solution here)
    $result = [];
    $size = $rowNumber + 1;
    for ($i = 0, $j = $rowNumber; $i < $size / 2; $i++, $j--) {
        if ($i === 0) {
            $result[$i] = 1;
            $result[$rowNumber] = 1;
        } elseif ($i === 1) {
            $result[$i] = $rowNumber;
            $result[$j] = $rowNumber;
        } elseif ($i === 2) {
            $result[$i] = $rowNumber * ($rowNumber - 1) / 2;
            $result[$j] = $result[$i];
        } elseif ($i === 3) {
            $result[$i] = $rowNumber * ($rowNumber - 1) * ($rowNumber - 2) / 6;
            $result[$j] = $result[$i];
        } else {
            $result[$i] = fact($rowNumber) / fact($i) * fact($rowNumber - $i);
            $result[$j] = $result[$i];
        }
    } return $result;
    // END
}

// BEGIN
$currentRow = [1];
for ($i = 0; $i < $rowNumber; $i++) {
    $newRow = [];
    for ($j = 0; $j <= $rowNumber; $j++) {
        $first = $currentRow[$j - 1] ?? 0;
        $second = $currentRow[$j] ?? 0;
        $newRow[$j] = $first + $second;
    }
    $currentRow = $newRow;
}

return $currentRow;
// END