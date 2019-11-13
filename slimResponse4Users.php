<?php

/**
  public/index.php
 * Реализуйте обработчики для списка пользователей /users и вывода конкретного пользователя /users/{id}.
 * Список пользователей генерируется в начале скрипта.

templates/users/index.phtml
 * Реализуйте вывод списка пользователей (/users) со ссылкой на просмотр каждого из них. Список пользователей
 * выведите в табличном виде с полями: id и firstName. firstName сделайте ссылкой на страницу конкретного пользователя.

templates/users/show.phtml
 * Реализуйте вывод всех полей пользователя по маршуту /users/{id}. Вывод организуйте как вам удобно (проще всего
 * использовать таблицу).
 */

 // public/index.php

use Slim\Factory\AppFactory;
use DI\Container;

require '/composer/vendor/autoload.php';

// Список пользователей
// Каждый пользователь – ассоциативный массив следующей структуры: id, firstName, lastName, email
$users = App\Generator::generate(100);

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

// BEGIN (write your solution here)

$app->get('/users', function ($request, $response) use ($users) {
    $params = [
        'users' => $users
    ];
    return $this->get('renderer')->render($response, 'users/index.phtml', $params);
});

$app->get('/users/{id}', function ($request, $response, $args) use ($users) {
    $id = $args['id'];
    $user = collect($users)->firstWhere('id', $id);
    $params = [
        'user' => $user
    ];
    return $this->get('renderer')->render($response, 'users/show.phtml', $params);
});
// END

$app->run();

// templates/users/index.phtml

// BEGIN (write your solution here)
<table>
    <?php foreach ($users as $user): ?>
        <tr>
        <td>
            <?= $user['id'] ?>
        </td>
        <td>
            <a href="/users/<?= $user['id']; ?>"><?= $user['firstName'] ?></a>
        </td>
    </tr>
    <?php endforeach ?>
</table>
<!-- END -->

<!-- templates/users/show.phtml -->
<a href="/users">Пользователи</a>

<!-- BEGIN (write your solution here) -->
<?php foreach ($user as $key => $value): ?>
    <div>
        <?= $key ?>: <?= $value ?>
    </div>
<?php endforeach; ?>
<!-- END -->
