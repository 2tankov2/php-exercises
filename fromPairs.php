<?php
/**
 * Реализуйте функцию fromPairs, которая принимает на вход массив, состоящий из массивов-пар,
 * и возвращает ассоциативный массив, полученный из этих пар.

 * Примечания
 * Если при конструировании объекта попадаются совпадающие ключи, то берётся ключ из последнего массива-пары:
   <?php

   fromPairs([['cat', 5], ['dog', 6], ['cat', 11]]
   // → ['dog' => 6, 'cat' => 11]

 */
namespace App\AssociativeArrays;

// BEGIN (write your solution here)
function fromPairs($data)
{
    $result = [];
    foreach ($data as $value) {
        $result[$value[0]] = $value[1];
    } return array_unique($result);
}
// END

// BEGIN
function fromPairs(array $data)
{
    $result = [];
    foreach ($data as [$key, $value]) {
        $result[$key] = $value;
    }

    return $result;
}
// END