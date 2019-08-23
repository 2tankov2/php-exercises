<?php
/**
 * Реализуйте функцию summaryRanges, которая находит в массиве непрерывные возрастающие последовательности чисел и
 * возвращает массив с их перечислением.

<?php

summaryRanges([]);
// → []

summaryRanges([1]);
// → []

summaryRanges([1, 2, 3]);
// → ["1->3"]

summaryRanges([0, 1, 2, 4, 5, 7]);
// → ["0->2", "4->5"]

summaryRanges([110, 111, 112, 111, -5, -4, -2, -3, -4, -5]);
// → ['110->112', '-5->-4']
 */
namespace App\Solution;

// BEGIN (write your solution here)
function summaryRanges($data)
{
    if (sizeof($data) < 2) {
        return [];
    }
    $result = [];
    $i = 0;
    foreach ($data as $key => $value) {
        if ($value === $data[0]) {
            $result[0][] = $value;
        } elseif ($value - $data[$key - 1] === 1) {
              $result[$i][] = $value;
        } else {
            $i++;
            $result[$i][] = $value;
        }
    }
    $arr = [];
    foreach ($result as $row) {
        $res = array_values(array_unique($row));
        $last = sizeof($res) - 1;
        if (sizeof($res) > 1) {
            $arr[] = "$res[0]->$res[$last]";
        }
    }
    return $arr;
}
// END

// BEGIN
function summaryRanges(Array $array)
{
    $result = [];

    if (empty($array)) {
        return $array;
    }

    $firstValue = $array[0];
    $firstIndex = 0;
    foreach ($array as $index => $value) {
        if ($index === 0) {
            continue;
        }
        $expectedValue = $array[$index - 1] + 1;
        if ($expectedValue !== $value) {
            if ($firstIndex !== $index - 1) {
                $result[] = "$firstValue->{$array[$index - 1]}";
            }
            $firstValue = $value;
            $firstIndex = $index;
        } elseif ($index === count($array) - 1) {
            $result[] = "$firstValue->{$array[$index]}";
        }
    }

    return $result;
}
// END