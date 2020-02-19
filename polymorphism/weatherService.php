<?php

/**
 * Создайте полноценное консольное приложение, которое показывает текущую погоду в городе. Оно работает так:

$ php bin/weather.php berlin
Temperature in berlin: 26C
 * Это консольное приложение обращается внутри себя к сервису погоды. Сервис погоды расположен на
 * localhost:8080. Информацию по городу можно извлечь сделав GET запрос на урл /api/v2/cities/<имя города>.
 * Данные от сервиса возвращаются в виде json: { "name": "<имя города>", temperature: "<температура>" }.

src\WeatherService.php
 * Реализуйте логику работы сервиса. Сделайте так, чтобы http-клиент не был зашит внутри класса, используйте
 * инъекцию зависимостей для проброса клиента во внутрь.

 * То как выполнять http-запросы через guzzle можно подсмотреть в его документации.

bin/weather.php
 * Реализуйте код, вызывающий сервис и печатающий на экран ожидаемую строку. Для извлечения города из
 * аргументов командной строки, воспользуйтесь массивом $argv. Первый аргумент (передаваемое имя города)
 * находится под индексом 1.
 */

// src\WeatherService.php
namespace App;
// BEGIN
class WeatherService
{
    private const API_URL = 'http://localhost:8080/api/v2';

    private $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function lookup($cityName)
    {
        $url = implode('/', [self::API_URL, "cities/{$cityName}"]);
        $response = $this->httpClient->get($url);
        return json_decode($response->getBody(), true);
    }
}
// E

// bin/weather.php

require '/composer/vendor/autoload.php';

use App\WeatherService;

// BEGIN
$weather = new WeatherService(new \GuzzleHttp\Client());
$data = $weather->lookup($argv[1]);
echo "Temperature in {$data['name']}: {$data['temperature']}C";
// END

