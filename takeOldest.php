<?php
/**
 * Реализуйте функцию takeOldest, которая принимает на вход список пользователей и возвращает самых взрослых.
 * Количество возвращаемых пользователей задается вторым параметром, который по-умолчанию равен единице.

<?php
$users = [
    ['name' => 'Tirion', 'birthday' => '1988-11-19'],
    ['name' => 'Sam', 'birthday' => '1999-11-22'],
    ['name' => 'Rob', 'birthday' => '1975-01-11'],
    ['name' => 'Sansa', 'birthday' => '2001-03-20'],
    ['name' => 'Tisha', 'birthday' => '1992-02-27']
];

takeOldest($users);
# => Array (
#   ['name' => 'Rob', 'birthday' => '1975-01-11']
# )
 */
namespace App\Users;

use function \Funct\Collection\firstN;

// BEGIN (write your solution here)
function takeOldest($data, $count = 1)
{
    usort($data, function ($a, $b) {
        $element1 = strtotime($a['birthday']);
        $element2 = strtotime($b['birthday']);
        if ($element1 == $element2) {
            return 0;
        }
        return $element1 > $element2 ? 1 : -1;
    });
    return  \Funct\Collection\firstN($data, $count);
}
// END

// BEGIN
function takeOldest(array $users, int $count = 1)
{
    usort($users, function ($user1, $user2) {
        return strtotime($user1['birthday']) <=> strtotime($user2['birthday']);
    });

    return firstN($users, $count);
}
// END