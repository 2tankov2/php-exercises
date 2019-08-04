<?php
/**
 * Реализуйте функцию union(...$arrays), которая находит объединение всех переданных массивов.
 * Функция принимает на вход от одного массива и больше. Ключи исходных массивов не сохраняются
 * (т.е. все значения итогового массива заново индексируются: 0, 1, 2, ...).

<?php

union([3]); // => [3]
union([3, 2], [2, 2, 1]); // => [3, 2, 1]
union(['a', 3, false], [true, false, 3], [false, 5, 8]); // => ['a', 3, false, true, 5, 8]
* Объединение работает только для плоских массивов, то есть массивов внутри которых нет других массивов.
 */
namespace App\Arrays;

function union($first, ...$rest)
{
    // BEGIN (write your solution here)
    $newArr = array_merge($first, ...$rest);
    $uniq = array_unique($newArr);
    $result = [];
    foreach ($uniq as $element) {
        if (!empty($element) || $element === false) {
            $result[] = $element;
        }
    } return $result;
    // END
}

// BEGIN
$mapWithUniqKeys = array_unique(array_merge($first, ...$rest));
return array_values($mapWithUniqKeys);
// END