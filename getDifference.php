<?php
/**
 * Реализуйте функцию getDifference, которая принимает на вход два массива, а возвращает массив, составленный
 * из элементов первого, которых нет во втором. Сделайте решение функциональным.

 * Эту задачу можно решить с помощью функции array_diff, но подразумевается что вы сделаете это без ее
 * использования.

<?php

getDifference([2, 1], [2, 3]);
// → [1]
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function getDifference($arr1, $arr2)
{
    $filtered = array_filter($arr1, function ($item) use ($arr2) {
        return !in_array($item, $arr2);
    });
    // Сбрасываем ключи
    return array_values($filtered);
}
// END
