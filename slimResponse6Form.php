<?php

/**
 * src/Validator.php
 * Реализуйте класс валидатор, который проверяет данные курса. Реализация должна соответствовать интерфейсу
 * ValidatorInterface.

 * Валидации:

 * Свойство paid - должно быть заполнено
 * Свойство title - должно быть заполнено
 * Если поле не заполнено, то используется сообщение Can't be blank

public/index.php
 * Реализуйте создание курсов в которое входит два обработчика /courses/new (отображает форму) и /courses создает курс.

 * Если данные формы валидны, то сохраните курс $repo->save($course) и выполните редирект на страницу со списком
 * курсов /courses. Если данные не валидны, то выведите форму с заполненными полями и сообщения об ошибках.

templates/courses/new.phtml
 * Выведите форму создания курса со следующими полями:

 * paid - селект определяющий платность курса (true/false)
 * title - имя курса
 * Подсказки
 * В случае ошибок валидации нужно возвращать код 422
 * При именовании полей в форме (аттрибут name) используйте схему, которая описана и показана в теории. Все данные
 * формы должны попадать в один массив, именем которого является имя сущности.
 */

//Validator.php

namespace App;

class Validator implements ValidatorInterface
{
    public function validate(array $course)
    {
        // BEGIN (write your solution here)
        $errors = [];
        if (empty($course['paid'])) {
            $errors['paid'] = "Can't be blank";
        } if (empty($course['title'])) {
            $errors['title'] = "Can't be blank";
        }
        return $errors;
        // END
    }
}

// ValidatorInterface.php

namespace App;

interface ValidatorInterface
{
    // Return array of errors, or empty array if no errors
    public function validate(array $data);
}

// Repository.php


namespace App;

class Repository
{
    public function __construct()
    {
        session_start();
    }

    public function all()
    {
        return array_values($_SESSION);
    }

    public function find(int $id)
    {
        return $_SESSION[$id];
    }

    public function save(array $item)
    {
        if (empty($item['title']) || $item['paid'] == '') {
            $json = json_encode($item);
            throw new \Exception("Wrong data: {$json}");
        }
        $item['id'] = uniqid();
        $_SESSION[$item['id']] = $item;
    }
}

// index.php

use Slim\Factory\AppFactory;
use DI\Container;
use App\Validator;

require '/composer/vendor/autoload.php';

$repo = new App\Repository();

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

$app->get('/courses', function ($request, $response) use ($repo) {
    $params = [
        'courses' => $repo->all()
    ];
    return $this->get('renderer')->render($response, 'courses/index.phtml', $params);
});

// BEGIN (write your solution here)
$app->get('/courses/new', function ($request, $response) {
    $params = [
        'course' => ['paid' => '', 'title' => ''],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, "courses/new.phtml", $params);
});

$app->post('/courses', function ($request, $response) use ($repo) {
    $validator = new Validator();
    $course = $request->getParsedBodyParam('course');
    $errors = $validator->validate($course);
    if (count($errors) === 0) {
        $repo->save($course);
        return $response->withHeader('Location', '/courses')
            ->withStatus(302);
    }
    $params = [
        'course' => $course,
        'errors' => $errors
    ];
    return $this->get('renderer')->render($response->withStatus(422), "courses/new.phtml", $params);
});
// END

$app->run();

?>

<!-- courses/new.phtml -->

<!-- BEGIN (write your solution here) -->
<form action="/courses" method="post">
    <div>
        <label>
            Платность курса
            <select name="course[paid]">
                <option value="">Select</option>
                <option <?= $course['paid'] === '1' ? 'selected' : '' ?> value="1">Платный</option>
                <option <?= $course['paid'] === '2' ? 'selected' : '' ?> value="2">Бесплатный</option>
            </select>
        </label>
        <?php if (isset($errors['paid'])): ?>
            <div><?= $errors['paid'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>
            Название курса
            <input type="text" name="course[title]" value="<?= htmlspecialchars($course['title']) ?>">
        </label>
        <?php if (isset($errors['title'])): ?>
            <div><?= $errors['title'] ?></div>
        <?php endif ?>
        </div>
    <input type="submit" value="Sign Up">
</form>
<!-- END -->

<!-- courses/index.phtml -->

<a href="/courses/new">Новый курс</a>

<?php foreach ($courses as $course): ?>
    <div>
        <?= htmlspecialchars($course['title']) ?>
    </div>
<?php endforeach ?>

<!-- index.phtml -->

<a href="/courses">Курсы</a>


