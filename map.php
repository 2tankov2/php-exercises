<?php
/**
 * Реализуйте набор функций, для работы со словарём, построенным на хеш-таблице. Для простоты, наша
 * реализация не поддерживает разрешение коллизий.

make() — создаёт новый словарь
set($map, $key, $value) — устанавливает в словарь значение по ключу. Работает и для создания и для изменения.
Функция возвращает true, если удалось установить значение. При возникновении коллизии, функция никак не меняет
словарь и возвращает false.
get($map, $key, $default = null) — читает значение по ключу.
Функции set и get принимают первым параметром словарь. Передача идет по ссылке, поэтому set может изменить его
напрямую.

Для полноценного погружения в тему, считаем, что массив в PHP может использоваться только как индексированный
массив.
 */
namespace App\Map;

// BEGIN (write your solution here)
function make()
{
    return [];
}

function set(&$map, $key, $value)
{
    $index = crc32($key) % 1000;
    if (array_key_exists($index, $map) && $map[$index][0] !== $key) {
        return false;
    }  return $map[$index] = [$key, $value];
}

function get($map, $key, $default = null)
{
    $index = crc32($key) % 1000;
    if (!array_key_exists($index, $map)) {
        return $default;
    }
    [, $value] = $map[$index];
    return $value;
}
// END

// BEGIN
function getIndex($key)
{
    return crc32($key) % 1000;
}

function make()
{
    return [];
}

function set(&$map, $key, $value)
{
    $index = getIndex($key);
    if (isset($map[$index])) {
        [$currentKey] = $map[$index];
        if ($currentKey != $key) {
            return false;
        }
    }
    $map[$index] = [$key, $value];
    return true;
}

function get($map, $key, $default = null)
{
    $index = getIndex($key);
    if (!isset($map[$index])) {
        return $default;
    }
    [, $value] = $map[$index];
    return $value;
}
// END