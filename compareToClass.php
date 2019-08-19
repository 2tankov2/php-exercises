<?php
/**
 * Реализуйте класс User, который создает пользователей. Конструктор класса принимает на вход два параметра:
 * идентификатор и имя.

 * Реализуйте интерфейс Comparable для класса User. Сравнение пользователей происходит на основе их идентификатора.

<?php

$user1 = new User(4, 'tolya');
$user2 = new User(1, 'petya');

$user1->compareTo($user2); // false  */
// src/Comparable.php

namespace App;

// BEGIN
interface Comparable
{
    public function compareTo($obj);
}
// END

// src/User.php
// BEGIN
class User implements Comparable
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function compareTo($user)
    {
        return $this->getId() === $user->getId();
    }
}
// END