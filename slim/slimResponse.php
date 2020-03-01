<?php

/**
 * Добавьте два обработчика:

 * /phones - возвращает список телефонов содержащихся в переменной
 * $phones закодированный в json
 * /domains - возвращает список доменов содержащихся в переменной
 * $domains закодированный в json
 */

use Slim\Factory\AppFactory;

require '/composer/vendor/autoload.php';

$faker = \Faker\Factory::create();
$faker->seed(1234);

$domains = [];
for ($i = 0; $i < 10; $i++) {
    $domains[] = $faker->domainName;
}

$phones = [];
for ($i = 0; $i < 10; $i++) {
    $phones[] = $faker->phoneNumber;
}

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response) {
    return $response->write('go to the /phones or /domains');
});

// BEGIN (write your solution here)
$app->get('/phones', function ($request, $response) use ($phones) {
    $newPhones = json_encode($phones);
    return $response->write($newPhones);
});

$app->get('/domains', function ($request, $response) use ($domains) {
    $newDomains = json_encode($domains);
    return $response->write($newDomains);
});
// END

$app->run();
