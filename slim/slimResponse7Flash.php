<?php

/**
public/index.php
 * Реализуйте два обработчика:

 * / — выводит флеш сообщения в шаблон templates/index.phtml
 * /courses — добавляет сообщение Course Added во Flash и делает редирект на /
templates/index.phtml
 * Реализуйте вывод Flash сообщений
 */

use DI\Container;
use Slim\Factory\AppFactory;

require '/composer/vendor/autoload.php';

session_start();

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});
$container->set('flash', function () {
    return new \Slim\Flash\Messages();
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// BEGIN (write your solution here)
$app->post('/courses', function ($request, $response) {

    $this->get('flash')->addMessage('success', 'Course Added');

    // Редирект
    return $response->withStatus(302)->withHeader('Location', '/');
});

$app->get('/', function ($request, $response) {
    // Извлечение flash сообщений установленных на предыдущем запросе
    $messages = $this->get('flash')->getMessages();
    $flash = json_encode($messages);

    $params = [
        'flash' => $flash
    ];
    return $this->get('renderer')->render($response, 'index.phtml', $params);
});
// END

// BEGIN
$app->get('/', function ($request, $response) {
    $flash = $this->get('flash')->getMessages();
    $params = ['flash' => $flash];
    return $this->get('renderer')->render($response, 'index.phtml', $params);
});

$app->post('/courses', function ($request, $response) {
    $this->get('flash')->addMessage('success', 'Course Added');
    return $response->withRedirect('/');
});
// END

$app->run();

// templates/index.phtml

<form action="/courses" method="post">
  <input type="submit" value="Create Course">
</form>

// BEGIN (write your solution here) -->
<div><?= $flash ?></div>
// END -->

<!-- BEGIN -->
<?php if (count($flash) > 0) : ?>
    <ul>
    <?php foreach ($flash as $messages) : ?>
        <?php foreach ($messages as $message) : ?>
            <li><?= $message ?></li>
        <?php endforeach ?>
    <?php endforeach ?>
    </ul>
<?php endif ?>
<!-- END -->