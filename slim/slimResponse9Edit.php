<?php

/**
public/index.php
 * Реализуйте следующие обработчики:

 * Форма редактирования поста: GET /posts/{id}/edit
 * Обновление поста: PATCH /posts/{id}
 * Посты содержат поля name и body, которые обязательны к заполнению. Валидация уже написана. После каждого успешного
 * действия нужно добавлять флеш сообщение и выводить его на списке постов. Текст:

 * Post has been updated
templates/posts/edit.phtml
 * Форма для редактирования поста. Общая часть формы уже выделена в шаблон _form, подключите его по аналогии с
 * templates/posts/new.phtml.

 * Подсказки
 * Для редиректов в обработчиках используйте именованный роутинг
 */

use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Middleware\MethodOverrideMiddleware;

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
$app->add(MethodOverrideMiddleware::class);

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

$app->get('/posts/new', function ($request, $response) use ($repo) {
    $params = [
        'postData' => [],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, 'posts/new.phtml', $params);
});

$app->post('/posts', function ($request, $response) use ($repo, $router) {
    $postData = $request->getParsedBodyParam('post');

    $validator = new App\Validator();
    $errors = $validator->validate($postData);

    if (count($errors) === 0) {
        $id = $repo->save($postData);
        $this->get('flash')->addMessage('success', 'Post has been created');
        return $response->withHeader('X-ID', $id)
                        ->withRedirect($router->urlFor('posts'));
    }

    $params = [
        'postData' => $postData,
        'errors' => $errors
    ];

    return $this->get('renderer')->render($response->withStatus(422), 'posts/new.phtml', $params);
});

// BEGIN (write your solution here)
$app->get('/posts/{id}/edit', function ($request, $response, array $args) use ($repo) {
    $id = $args['id'];
    $post = $repo->find($id);
    $params = [
        'post' => $post,
        'postData' => $post,
        'errors' => []
    ];
    return $this->get('renderer')->render($response, 'posts/edit.phtml', $params);
})->setName('editPost');

$app->patch('/posts/{id}', function ($request, $response, array $args) use ($repo, $router) {
    $id = $args['id'];
    $post = $repo->find($id);
    $data = $request->getParsedBodyParam('post');

    $validator = new App\Validator();
    $errors = $validator->validate($data);

    if (count($errors) === 0) {
        // Ручное копирование данных из формы в нашу сущность
        $post['name'] = $data['name'];

        $this->get('flash')->addMessage('success', 'Post has been updated');
        $repo->save($post);
        $url = $router->urlFor('posts', ['id' => $post['id']]);
        return $response->withRedirect($url);
    }

    $params = [
        'postData' => $data,
        'post' => $post,
        'errors' => $errors
    ];

    $response = $response->withStatus(422);
    return $this->get('renderer')->render($response, 'posts/edit.phtml', $params);
});
// END

$app->run();

// templates/posts/edit.phtml

<a href="/posts">Посты</a>

<!-- BEGIN (write your solution here) -->
<form action="/posts/<?= htmlspecialchars($post['id']) ?>" method="post">
    <input type="hidden" name="_METHOD" value="PATCH">
    <?php require '_form.phtml' ?>
    <input type="submit" value="Update">
</form>
<!-- END -->

// templates/posts/__form.phtml

<div>
    <label>
        Имя *
        <input type="text" name="post[name]" value="<?= htmlspecialchars($postData['name'] ?? '') ?>">
    </label>
    <?php if (isset($errors['name'])): ?>
        <div><?= $errors['name'] ?></div>
    <?php endif ?>
</div>
<div>
    <label>
        Содержимое *
    </label>
    <textarea type="text" rows="20" cols="80" name="post[body]"><?= htmlspecialchars($postData['body'] ?? '') ?></textarea>
    <?php if (isset($errors['body'])): ?>
        <div><?= $errors['body'] ?></div>
    <?php endif ?>
</div>
