<?php
/**
 * Реализуйте функцию getChildren, которая принимает на вход список пользователей и возвращает плоский
 * список их детей. Дети каждого пользователя хранятся в виде массива в ключе children

<?php

$users = [
    ['name' => 'Tirion', 'children' => [
        ['name' => 'Mira', 'birdhday' => '1983-03-23']
    ]],
    ['name' => 'Bronn', 'children' => []],
    ['name' => 'Sam', 'children' => [
        ['name' => 'Aria', 'birdhday' => '2012-11-03'],
        ['name' => 'Keit', 'birdhday' => '1933-05-14']
    ]],
    ['name' => 'Rob', 'children' => [
        ['name' => 'Tisha', 'birdhday' => '2012-11-03']
    ]],
];

getChildren($users);
// [
//     ['name' => 'Mira', 'birdhday' => '1983-03-23'],
//     ['name' => 'Aria', 'birdhday' => '2012-11-03'],
//     ['name' => 'Keit', 'birdhday' => '1933-05-14'],
//     ['name' => 'Tisha', 'birdhday' => '2012-11-03']
// ]
 */
namespace App\Users;

use function \Funct\Collection\flatten;

// BEGIN (write your solution here)
function getChildren($users)
{
    $children = array_map(function ($user) {
        return $user['children'];
    }, $users);
    return flatten($children);
}
// END