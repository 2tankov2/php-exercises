<?php

/**
SolutionTest.php
 * Напишите тесты на класс Config, который принимает на вход вложенный массив и рекурсивно строит цепочку вложенных конфигов.
 * Напишите тесты на метод toArray класса Config, который возвращает массив значений для текущего уровня вложенности конфига.
 * Пример:

<?php

$data = [
    'key' => 'value',
    'deep' => [
        'key' => [],
        'deep' => 3,
        'another' => 7
    ]
];

$config = new Config($data);

// how it works

$config->key; // 'value'
$config->deep->another; // => 7

$config->deep->toArray();
// => ['key' => [], 'deep' => 3, 'another' => 7]
 * Другими словами из массива строится дерево объектов (на основе этого же массива), которое позволяет заменить
 * обращение с $data['deep']['key'] на $config->deep->key. Соответственно нужно проанализировать массив использующийся
 * в тестах для создания объекта Config и проверить то что он правильно построился сравнив значения по соответствующему
 * пути в массиве и объекте.
 */

namespace App;

use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    private $config;
    private $data;

    public function setUp()
    {
        $this->data = [
            'key' => 'value',
            'deep' => [
                'key' => [],
                'deep' => 3,
                'another' => 7
            ]
        ];

        $this->config = new Config($this->data);
    }
    public function testSimpleKey()
    {
        // BEGIN (write your solution here)
        $this->assertEquals('value', $this->config->key);
        // END
    }

    public function testDeepKey()
    {
        // BEGIN (write your solution here)
        $this->assertEquals([], $this->config->deep->key);
        $this->assertEquals('3', $this->config->deep->deep);
        $this->assertEquals('7', $this->config->deep->another);
        // $this->assertEquals([], $this->config->deep->value);
        // END
    }

    public function testToArray()
    {
        // BEGIN (write your solution here)
        $this->assertEquals($this->data['deep'], $this->config->deep->toArray());
        // END
    }
}
