<?php
/**
 * Реализуйте функцию toStd, которая принимает на вход ассоциативный массив и возвращает объект типа stdClass такой же
 * структуры. Выполните задачу проставляя ключи и значения вручную без использования преобразования типа.

<?php

$data = [
    'key' => 'value',
    'key2' => 'value2',
];
$config = toStd($data);

$config->key; // value
$config->key2; // value2
 * Это задание можно решить простым преобразованием типа (в object), но это не спортивно)

 * Подсказки
 * Вам понадобится динамическое обращение к свойствам:

<?php

$name = 'key'
$obj->$key;
 */
namespace App\Converter;

// BEGIN (write your solution here)
function toStd($array)
{
    $obj = new \stdClass();

    foreach ($array as $key => $value) {
        $obj->$key = $value;
    } return $obj;
}
// END
