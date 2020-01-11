<?php

/**
public/index.php
 * Реализуйте следующие обработчики:

 * Список постов: /posts
 * Конкретный пост /posts/:id (например /posts/3)
 * Посты находятся в репозитории $repo. Каждый пост содержит внутри себя четыре поля:

id
name
body
slug
 * Каждый пост из списка ведет на страницу конкретного поста. Список нужно вывести с пейджингом по 5 постов на странице.
 * На первой странице первые пять постов, на второй вторые пять и так далее. Переключение между страницами нужно сделать
 * двумя кнопками: назад и вперед. То какая сейчас страница открыта, определяется параметром page. По умолчанию загружается
 * первая страница.

 * Страница конкретного поста отображает данные поста и позволяет вернуться на список. Если поста не существует, то страница
 * обработчик должен вернуть код ответа 404 и текст Page not found.

templates/posts/index.phtml
 * Выведите список добавленных постов. Каждый пост это имя, которое представлено ссылкой ведущей на отображение (show).

templates/posts/show.phtml
 * Вывод информации о конкретном посте. Выводить только имя и содержимое поста.

 * Подсказки
 * Для реализации пейджинга понадобится извлечь все посты из репозитория с помощью метода all().
 */

 // public/index.php
use Slim\Factory\AppFactory;
use DI\Container;

require '/composer/vendor/autoload.php';

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$repo = new App\Repository();

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

// BEGIN (write your solution here)
$app->get('/posts', function ($request, $response) use ($repo) {
    $posts = $repo->all();
    $page = $request->getQueryParam('page', 1);
    $per = 5;
    $offset = ($page - 1) * $per;
    // In real life this request is bad, because it pull all data from the database
    // It would be better to do sql query with LIMIT and OFFSET
    $sliceOfPosts = array_slice($posts, $offset, $per);
    $params = [
        'posts' => $sliceOfPosts,
        'page' => $page
    ];
    return $this->get('renderer')->render($response, 'posts/index.phtml', $params);
});

$app->get('/posts/{id}', function ($request, $response, array $args) use ($repo) {
    $id = $args['id'];
    $post = collect($repo)->flatten(1)->firstWhere('id', $id);

    if (!$post) {
        return $response->withStatus(404)->write('Page not found');
    }
    $params = [
        'post' => $post
    ];
    return $this->get('renderer')->render($response, 'posts/show.phtml', $params);
});

// END

$app->run();

// templates/posts/index.phtml
// BEGIN (write your solution here)
<div>
    <?php foreach ($posts as $post): ?>
        <div>
            <a href="/posts/<?= $post['id'] ?>"><?= $post['name'] ?></a>
        </div>
    <?php endforeach ?>
</div>
<a href="/posts?page=<?= $page < 2 ? 1 : $page - 1 ?>">ПРЕДЫДУЩАЯ</a>
<a href="/posts?page=<?= $page + 1; ?>">СЛЕДУЮЩАЯ</a>
<!-- END -->

// templates/posts/show.phtml
<a href="/posts">Посты</a>

<!-- BEGIN (write your solution here) -->
<h2><?= $post['name'] ?></h2>
<div><?= $post['body'] ?></div>
<!-- END -->
