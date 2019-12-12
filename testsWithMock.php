<?php

/**
 * Существует подход для работы с базой данных, в котором сама сущность отвечает за свое сохранение в базу. Этот подход
 * называется ActiveRecord. С точки зрения грамотной архитектуры это решение не очень хорошее, но благодаря простой
 * реализации является весьма популярным среди программистов. Да и большинство фреймворков внутри себя содержат orm,
 * реализованную именно как ActiveRecord.

tests/SolutionTest.php
 * Напишите тесты на то, что внутри класса User правильно вызывается метод query объекта, отвечающего за соединение
 * с базой данных. Правила работы метода query такие:

 * Вызов save на свежесозданном объекте приводит к однократному вызову query.
 * Повторный вызов (без изменения объекта) не выполняет запроса к базе.
 * Вызов методов setFirstName или setLastName приводит к тому что сохранение снова выполнит запрос.
 * Пример:

<?php

$connection = new Db();
$user = new User($connection);

$user->save(); // true
$user->setFirstName("John");
$user->save(); // true
$user->save(); // false
 */

namespace App\Tests;
use Variant\User;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    private $user;
    private $dbMock;
    
    public function setUp()
    {
        $this->dbMock = $this->getMockBuilder('\App\DbInterface')
            ->setMethods(['query', 'transaction'])
            ->getMock();

        $this->user = new User($this->dbMock);
    }

    public function testFreshSave()
    {
        $this->dbMock
            ->expects($this->once())
            ->method('query');
            
        $this->user->save();
    }


    public function testFreshSaveWithArgument()
    {
        $this->dbMock
            ->expects($this->once())
            ->method('query');
    
        $this->user->save();
        $this->user->save();
    }

    public function testRepitedSave()
    {
        $this->dbMock
            ->expects($this->exactly(2))
            ->method('query');

        $this->user->setFirstName('Name');
        $this->user->save();
        $this->user->setLastName('LastName');
        $this->user->save();

        $this->user->save();        
    }
    // END
}