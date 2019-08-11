<?php
/**
 * Реализуйте функцию findWhere, которая принимает на вход массив (элементы которого - ассоциативные массивы) и пары
 * ключ-значение (тоже в виде массива), а возвращает первый элемент исходного массива, значения которого соответствуют
 * переданным парам (всем переданным). Если совпадений не было, то функция должна вернуть null.

<?php

findWhere(
    [
        ['title' => 'Book of Fooos', 'author' => 'FooBar', 'year' => 1111],
        ['title' => 'Cymbeline', 'author' => 'Shakespeare', 'year' => 1611],
        ['title' => 'The Tempest', 'author' => 'Shakespeare', 'year' => 1611],
        ['title' => 'Book of Foos Barrrs', 'author' => 'FooBar', 'year' => 2222],
        ['title' => 'Still foooing', 'author' => 'FooBar', 'year' => 3333],
        ['title' => 'Happy Foo', 'author' => 'FooBar', 'year' => 4444],
    ],
    ['author' => 'Shakespeare', 'year' => 1611]
); // => ['title' => 'Cymbeline', 'author' => 'Shakespeare', 'year' => 1611]
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function findWhere($data, $where)
{
    $result = [];
    foreach ($data as $row) {
        if (array_intersect($where, $row) === $where) {
            $result[] = $row;
        }
    } if (sizeof($result) === 0) {
        return null;
    } return $result[0];
}
// END

// BEGIN
function findWhere($data, $where)
{
    foreach ($data as $item) {
        $find = true;
        foreach ($where as $key => $value) {
            if ($item[$key] !== $value) {
                $find = false;
            }
        }
        if ($find) {
            return $item;
        }
    }
}
// END