<?php
/**
 * Реализуйте функцию getSortedNames, которая принимает на вход список пользователей,
 * извлекает их имена, сортирует и возвращает отсортированный список имен.

<?php

$users = [
    ['name' => 'Bronn', 'gender' => 'male', 'birthday' => '1973-03-23'],
    ['name' => 'Reigar', 'gender' => 'male', 'birthday' => '1973-11-03'],
    ['name' => 'Eiegon',  'gender' => 'male', 'birthday' => '1963-11-03'],
    ['name' => 'Sansa', 'gender' => 'female', 'birthday' => '2012-11-03']
];

getSortedNames($users); // => ['Bronn', 'Eiegon', 'Reigar', 'Sansa']
 */
namespace App\Arrays;

// BEGIN (write your solution here)
function getSortedNames($persons)
{
    $result = [];
    foreach ($persons as ["name" => $name]) {
        $result[] = $name;
    } sort($result);
    return $result;
};
// END
