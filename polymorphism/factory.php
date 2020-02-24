<?php

/**
 * src/ConfigFactory.php
 * Создайте фабрику, которая принимает на вход путь до файла конфигурации в формате либо json либо yaml
 * и возвращает объект класса Config. Конструктор класса Config принимает на вход массив с данными,
 * полученными из конфигурационных файлов и предоставляет к нему объектный доступ.

<?php

$config = ConfigFactory::build(__DIR__ . '/fixtures/test.yml');
$config->key; // value
print_r(get_class($config)); // Config

$config = ConfigFactory::build(__DIR__ . '/fixtures/test2.yaml');
$config->key; // another value
print_r(get_class($config)); // Config

$config2 = ConfigFactory::build(__DIR__ . '/fixtures/test.json');
$config2->key; // something else
 * Учтите что файлы формата YAML могут иметь разные расширения: yaml и yml. Фабрика должна работать с обоими.

// src/parsers/JsonParser.php
 * Реализуйте класс, отвечающий за парсинг json. Используйте внутри json_decode, в котором второй параметр true.

// src/parsers/YamlParser.php
 * Реализуйте класс, отвечающий за парсинг yaml. Для парсинга используется сторонний компонент со следующим
 * интерфейсом:

<?php

Yaml::parse($data);
 */

 // src/ConfigFactory.php

namespace App;

use App\parsers\JsonParser;
use App\parsers\YamlParser;

 // BEGIN (write your solution here)
class ConfigFactory
{
    public static function build($pathToFile)
    {
        $row = file_get_contents($pathToFile, FILE_USE_INCLUDE_PATH);
        $format = pathinfo($pathToFile, PATHINFO_EXTENSION);
        $mapping = [
             'yaml' => YamlParser::class, // App\parsers\YamlParser
             'yml' => YamlParser::class, // App\parsers\YamlParser
             'json' => JsonParser::class  // App\parsers\JsonParser
        ];
        
        $className = $mapping[$format];
        $data =  $className::parse($row);
        return new Config($data);
    }
}
 // END

 // src/JsonParser.php

namespace App\parsers;

 // BEGIN (write your solution here)
class JsonParser
{
    public static function parse($data)
    {
        return  json_decode($data, true);
    }
}
 // END

 // src/JamlParser.php


namespace App\parsers;

use Symfony\Component\Yaml\Yaml;

 // BEGIN (write your solution here)
class YamlParser
{
    public static function parse($data)
        {
        return Yaml::parse($data);
    }
}
 // END
