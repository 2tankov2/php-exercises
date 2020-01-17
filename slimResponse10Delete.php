<?php

/**
public/index.php
 * Реализуйте удаление поста (обработчик DELETE /posts/{id})

 * После каждого успешного действия нужно добавлять флеш сообщение и выводить его на списке постов. Текст:

 * Post has been removed
templates/posts/index.phtml
 * Реализуйте вывод списка постов и добавьте к каждому посту кнопку на удаление.

 * Подсказки
 * Для редиректов в обработчиках используйте именованный роутинг
 */

 // public/index.php
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
$app->add(MethodOverrideMiddleware::class);
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
$app->delete('/posts/{id}', function ($request, $response, array $args) use ($repo, $router) {
    $id = $args['id'];
    $repo->destroy($id);
    $this->get('flash')->addMessage('success', 'Post has been deleted');
    return $response->withRedirect($router->urlFor('posts'));
});
// END

$app->run();

// templates/posts/index.phtml

<?php foreach ($flash as $messages): ?>
    <?php foreach ($messages as $message): ?>
        <li><?= $message ?></li>
    <?php endforeach ?>
<?php endforeach ?>
</ul>
<?php endif ?>

<a href="/posts/new">Новый пост</a>

<!-- BEGIN (write your solution here) -->
<table>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td>
                <a href="/posts/<?= $post['id'] ?>"><?= $post['name'] ?></a>
            </td>
            <td>
                <form action="/posts/<?= $post['id'] ?>" method="post">
                    <input type="hidden" name="_METHOD" value="DELETE">
                    <input type="submit" value="X">
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<!-- END -->
