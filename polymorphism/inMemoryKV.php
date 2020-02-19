<?php

/**
 * В этом задании используется класс InMemoryKV, с которым вы недавно работали. Теперь мы добавим ему интерфейс
 * и дополнительно реализуем сериализацию.

src\KeyValueStorageInterface.php
 * Реализуйте интерфейс KeyValueStorageInterface, который расширяет интерфейс \Serializable и имеет следующие
 * методы:

set($key, $value);
get($key, $default = null);
unset($key);
toArray();
src\InMemoryKV.php
 * Реализуйте в классе InMemoryKV интерфейс \Serializable, который встроен в PHP. Этот интерфейс позволяет
 * применять к объектам методы serialize и unserialize.

 * Функция serialize позволяет представить объект строкой и сохранить его куда-нибудь в файловую систему или
 * передать по сети. Функция unserialize выполняет обратную операцию и восстанавливает сериализованный объект.

 * Для сериализации используйте json_encode, для десериализации json_decode.
 */

// src\KeyValueStorageInterface.php

namespace App;

// BEGIN (write your solution here)
interface KeyValueStorageInterface extends \Serializable
{
    public function set($key, $value);
    public function get($key, $default = null);
    public function unset($key);
    public function toArray();
}
// END


// src\InMemoryKV.php

namespace App;

class InMemoryKV implements KeyValueStorageInterface
{
    private $map;

    public function __construct($initial = [])
    {
        $this->map = $initial;
    }

    public function set($key, $value)
    {
        $this->map[$key] = $value;
    }

    public function unset($key)
    {
        unset($this->map[$key]);
    }

    public function get($key, $default = null)
    {
        return $this->map[$key] ?? $default;
    }

    public function toArray()
    {
        return $this->map;
    }

    // BEGIN (write your solution here)
    public function serialize()
    {
        return json_encode($this->map);
    }

    public function unserialize($serialized)
    {
        $this->map = json_decode($data, true);
    }
    // END
}
