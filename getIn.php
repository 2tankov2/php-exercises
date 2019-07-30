<?php
/**
 * Реализуйте функцию getIn, которая извлекает из массива (который может быть любой глубины вложенности)
 * значение по указанным ключам. Аргументы:

* Исходный массив
* Массив ключей, по которым ведется поиск значения
* В случае, когда добраться до значения невозможно, возвращается null.

<?php

$data = [
    'user' => 'ubuntu',
    'hosts' => [
        ['name' => 'web1'],
        ['name' => 'web2']
    ]
];

getIn($data, ['undefined']);        // => null
getIn($data, ['user']);             // => 'ubuntu'
getIn($data, ['user', 'ubuntu']);   // => null
getIn($data, ['hosts', 1, 'name']); // => 'web2'
getIn($data, ['hosts', 0]);         // => ['name' => 'web1']
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function getIn($arr, $keys)
{
    if (count($keys) < 1) {
        return null;
    }
    $size = sizeof($keys);
    $newArr = $arr;
    for ($i = 0; $i < $size; $i++) {
        $key = $keys[$i];
        if (is_array($newArr) && array_key_exists($key, $newArr)) {
            $result = $newArr[$key];
            $newArr = $newArr[$key];
            $swapped = true;
        } else {
            $result = null;
        }
    } return $result;
};
// END

// BEGIN
function getIn(array $data, array $keys)
{
    $current = $data;
    foreach ($keys as $key) {
        if (!isset($current[$key])) {
            return null;
        }
        $current = $current[$key];
    }

    return $current;
}
// END
