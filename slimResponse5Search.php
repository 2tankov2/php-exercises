<?php

/**
 * public/index.php
 * Реализуйте обработчик /users, который формирует список пользователей. Обработчик поддерживает фильтрацию через
 * параметр term, в котором передается firstName, возвращающий все совпадения по началу имени пользователя. Список
 * пользователей доступен в переменной $users.

 * templates/users/index.phtml
 * Реализуйте вывод списка пользователей и формы для фильтрации
 */

 // public/index.php

use Slim\Factory\AppFactory;
use DI\Container;

use function Stringy\create as s;

require '/composer/vendor/autoload.php';

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

// BEGIN
$app->get('/users', function ($request, $response) use ($users) {
    $term = $request->getQueryParam('term');
    $result = collect($users)->filter(function ($user) use ($term) {
        return s($user['firstName'])->startsWith($term, false);
    });
    $params = [
        'users' => $result,
        'term' => $term
    ];
    return $this->get('renderer')->render($response, 'users/index.phtml', $params);
});
// END

$app->run();

// templates/users/index.phtml

<a href="/users">Все Пользователи</a>

// BEGIN -->
<form action="/users">
  <input type="search" name="term" value="<?= htmlspecialchars($term) ?>">
  <input type="submit" value="Search">
</form>

<?php foreach ($users as $user): ?>
  <div>
    <?= htmlspecialchars($user['firstName']) ?>
  </div>
<?php endforeach ?>
<!-- END -->