<?php

/**
 * В этой практике необходимо реализовать систему аутентификации. В простейшем случае она состоит из двух маршрутов:

 * POST /session - создает сессию
 * DELETE /session - удаляет сессию
 * После выполнения каждого из этих действий происходит редирект на главную.

templates/index.phtml
 * Если пользователь не аутентифицирован, то ему показывается форма с текстом "Sign In" полем для ввода имени и пароля.
 * Если аутентифицирован, то его имя и форма с кнопкой "Sign Out".

public/index.php
 * Реализуйте указанные выше маршруты и дополнительно маршрут /

 * Список пользователей с именами и паролями доступен в массиве $users. Обратите внимание на то что пароль хранится в
 * зашифрованном виде (их не хранят в открытом виде). Это значит, что при сравнении необходимо шифровать пароль,
 * приходящий от пользователя, и сравнивать хеши.

 * Если имя или пароль неверные, то происходит редирект на главную, и показывается флеш сообщение Wrong password or name.
 */

 //public/index.php
use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Middleware\MethodOverrideMiddleware;

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
$app->add(MethodOverrideMiddleware::class);

$users = [
    ['name' => 'admin', 'passwordDigest' => hash('sha256', 'secret')],
    ['name' => 'mike', 'passwordDigest' => hash('sha256', 'superpass')],
    ['name' => 'kate', 'passwordDigest' => hash('sha256', 'strongpass')]
];

// BEGIN (write your solution here)

$app->get('/', function ($request, $response) {
    $flash = $this->get('flash')->getMessages();

    $params = [
        'flash' => $flash,
        'user' => ['name' => '', 'password' => '']
    ];
    return $this->get('renderer')->render($response, 'index.phtml', $params);
});

$app->post('/session', function ($request, $response) use ($users) {
    
    $userData = $request->getParsedBodyParam('user');

    $user = collect($users)->firstWhere('name', $userData['name']);

    if (($user) && ($user['passwordDigest'] === hash('sha256', $userData['password']))) {
        $_SESSION['user'] = $userData;
        
        return $response->withRedirect('/');
    }

    $this->get('flash')->addMessage('success', 'Wrong password or name');
    
    return $response->withRedirect('/');
});

$app->delete('/session', function ($request, $response) {
    $_SESSION = [];
    session_destroy();
    return $response->withRedirect('/');
});
// END

$app->run();

///////
// BEGIN
$app->get('/', function ($request, $response) {
    $flash = $this->get('flash')->getMessages();
    $params = [
        'currentUser' => $_SESSION['user'] ?? null,
        'flash' => $flash
    ];
    return $this->get('renderer')->render($response, 'index.phtml', $params);
});

$app->post('/session', function ($request, $response) use ($users) {
    $userData = $request->getParsedBodyParam('user');

    $user = collect($users)->first(function ($user) use ($userData) {
        return $user['name'] == $userData['name']
            && hash('sha256', $userData['password']) == $user['passwordDigest'];
    });

    if ($user) {
        $_SESSION['user'] = $user;
    } else {
        $this->get('flash')->addMessage('error', 'Wrong password or name');
    }
        return $response->withRedirect('/');
});

$app->delete('/session', function ($request, $response) {
    $_SESSION = [];
    session_destroy();
    return $response->withRedirect('/');
});
// END

//templates/index.phtml
<?php if (count($flash) > 0): ?>
    <ul>
    <?php foreach ($flash as $messages): ?>
        <?php foreach ($messages as $message): ?>
            <li><?= $message ?></li>
        <?php endforeach ?>
    <?php endforeach ?>
    </ul>
    <?php endif ?>

    <!-- BEGIN (write your solution here) -->
    <?php if (!isset($_SESSION['user'])) : ?>
    <form action="/session" method="post">
        <div>
            <label>
                Имя пользователя
                <input type="text" name="user[name]" value="<?= htmlspecialchars($user['name']) ?>">
                </select>
            </label>
        </div>
        <div>
            <label>
                Пароль
                <input type="text" name="user[password]" value="<?= htmlspecialchars($user['password']) ?>">
            </label>
            </div>
        <input type="submit" value="Sign In">
    </form>
    <?php else : ?>
    <p><?= htmlspecialchars($_SESSION['user']['name']) ?></p>
    <form action="/session" method="post">
        <input type="hidden" name="_METHOD" value="DELETE">
        <input type="submit" value="Sign Out">
    </form>
    <?php endif ?>
<!-- END -->
///
<!-- BEGIN -->
<?php if ($currentUser): ?>
    <div><?= $currentUser['name'] ?></div>
    <form action="/session" method="post">
        <input type="hidden" name="_METHOD" value="DELETE">
        <input type="submit" value="Sign Out">
    </form>
<?php else: ?>
    <form action="/session" method="post">
        <input type="text" required name="user[name] "value="">
        <input type="password" required name="user[password] "value="">
        <input type="submit" value="Sign In">
    </form>
<?php endif; ?>
<!-- END -->
