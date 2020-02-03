<?php

/**
 * src\DatabaseConfigLoader.php
* Реализуйте класс DatabaseConfigLoader, который отвечает за загрузку конфигурации для базы данных.
* У класса следующий интерфейс:

* Конструктор - принимает на вход путь, по которому нужно искать конфигурацию
* load($env) - метод, который грузит конфигурацию для конкретной среды окружения. Она загружает файл
* database.{$env}.json, парсит его и возвращает результат наружу.
<?php

$loader = new DatabaseConfigLoader(__DIR__ . '/fixtures');
$config = $loader->load('production'); // loading database.production.json
// [
//     'host' => 'google.com',
//     'username' => 'postgres'
// ];
* В этом классе и конфигурации реализована поддержка расширения. Если в загружаемом конфиге есть ключ
* extend, то нужно загрузить конфигурацию с этим именем (он соответствует $env). Далее конфигурации
* мержатся между собой так, что приоритет имеет загруженный раньше. Более подробный пример посмотрите в тестах.
 */

namespace App;

// BEGIN (write your solution here)
class DatabaseConfigLoader
{
    private $filePath;

    public function __construct($path)
    {
        $this->filePath = $path;
    }
    public function load($env)
    {
        $fileName = $this->filePath . "/database.{$env}.json";
        $raw = file_get_contents($fileName);
        $config = json_decode($raw, true);
        if (array_key_exists('extend', $config)) {
            $env = $config['extend'];
            $fileName = $this->filePath . "/database.{$env}.json";
            $raw = file_get_contents($fileName);
            $oldConfig = array_filter($config, function ($item) use ($env) {
                return $item != $env;
            });
            $newConfig = array_merge(json_decode($raw, true), $oldConfig);
            return $newConfig;
        }
        return $config;
    }
}
// END

// BEGIN
class DatabaseConfigLoader
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function load($name)
    {
        $filename = "database.{$name}.json";
        $raw = file_get_contents($this->path . '/' . $filename);
        $config = json_decode($raw, true);
        if (!isset($config['extend'])) {
            return $config;
        }
        $newName = $config['extend'];
        unset($config['extend']);
        return array_merge($this->load($newName), $config);
    }
}
// END
