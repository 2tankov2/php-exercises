<?php

/**
public/index.php
 * Реализуйте следующие обработчики:

 * Форма создания нового поста: GET /posts/new
 * Создание поста: POST /posts
 * Посты содержат два поля name и body, которые обязательны к заполнению. Валидация уже написана.

 * Реализуйте вывод ошибок валидации в форме.
 * После каждого успешного действия нужно добавлять флеш сообщение и выводить его на списке постов. Текст:

 * Post has been created
templates/posts/new.phtml
 * Форма для создания поста

 * Подсказки
 * Для редиректов в обработчиках используйте именованный роутинг
 */

 // public/index.php

use Slim\Factory\AppFactory;
use DI\Container;

require '/composer/vendor/autoload.php';

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

$repo = new App\Repository();
$router = $app->getRouteCollector()->getRouteParser();

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

$app->get('/posts', function ($request, $response) use ($repo) {
    $flash = $this->get('flash')->getMessages();

    $params = [
        'flash' => $flash,
        'posts' => $repo->all()
    ];
    return $this->get('renderer')->render($response, 'posts/index.phtml', $params);
})->setName('posts');

// BEGIN (write your solution here)
$app->get('/posts/new', function ($request, $response) {
    $params = [
        'postData' => [],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, 'posts/new.phtml', $params);
})->setName('newPost');


$app->post('/posts', function ($request, $response) use ($router, $repo) {
    // Извлекаем данные формы
    $postData = $request->getParsedBodyParam('post');

    $validator = new App\Validator();
    // Проверяем корректность данных
    $errors = $validator->validate($postData);

    if (count($errors) === 0) {
        // Если данные корректны, то сохраняем, добавляем флеш и выполняем редирект
        $repo->save($postData);
        $this->get('flash')->addMessage('success', 'Post has been created');
        // Обратите внимание на использование именованного роутинга
        $url = $router->urlFor('posts');
        return $response->withRedirect($url);
    }

    $params = [
        'postData' => $postData,
        'errors' => $errors
    ];

    // Если возникли ошибки, то устанавливаем код ответа в 422 и рендерим форму с указанием ошибок
    $response = $response->withStatus(422);
    return $this->get('renderer')->render($response, 'posts/new.phtml', $params);
});
// END

$app->run();

// templates/posts/new.phtml

<a href="/posts">Посты</a>

// BEGIN (write your solution here)
<form action="/posts" method="post">
    <div>
        <label>
            Название *
            <input type="text" name="post[name]" value="<?= htmlspecialchars($postData['name'] ?? ''); ?>">
        </label>
        <?php if (isset($errors['name'])): ?>
            <div><?= $errors['name'] ?></div>
        <?php endif ?>
        </div>
    </div>
    <div>
        <label>
            Описание *
            <input type="text" name="post[body]" value="<?= htmlspecialchars($postData['body'] ?? ''); ?>">
        </label>
        <?php if (isset($errors['body'])): ?>
            <div><?= $errors['body'] ?></div>
        <?php endif ?>
        </div>
    </div>
    <input type="submit" value="Create">
</form>
<!-- END -->
