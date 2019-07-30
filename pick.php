<?php
/**
 * Реализуйте функцию pick, которая извлекает из переданного массива все элементы по указанным ключам и
 * возвращает новый массив. Аргументы:

* Исходный массив
* Массив ключей, по которым должны быть выбраны элементы (ключ и значение) из исходного массива,
* и на основе выбранных данных сформирован новый массив

$data = [
    'user' => 'ubuntu',
    'cores' => 4,
    'os' => 'linux'
];

pick($data, ['user']);       // → ['user' => 'ubuntu']
pick($data, ['user', 'os']); // → ['user' => 'ubuntu', 'os' => 'linux']
pick($data, []);             // → []
pick($data, ['none']);       // → []
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function pick($data, $keys)
{
    $result = [];
    foreach ($data as $key => $value) {
        if (in_array($key, $keys)) {
            $result += [$key => $value];
        }
    }
    return $result;
}
// END

// BEGIN
function pick(array $data, array $keys)
{
    $result = [];
    foreach ($data as $key => $value) {
        if (in_array($key, $keys)) {
            $result[$key] = $value;
        }
    }

    return $result;
}
// END