<?php

/**src\HTML.php
* Реализуйте функцию getLinks($tags), которая принимает на вход список тегов, находит среди них теги a,
* link и img, а затем извлекает ссылки и возвращает список ссылок. Теги подаются на вход в виде массива,
* где каждый элемент это тег. Тег имеет следующую структуру:

* name - имя тега.
* href или src - атрибуты. Атрибуты зависят от тега: img - src, a - href, link - href.

<?php

use function App\HTML\getLinks;

$tags = [
    ['name' => 'img', 'src' => 'hexlet.io/assets/logo.png'],
    ['name' => 'div'],
    ['name' => 'link', 'href' => 'hexlet.io/assets/style.css'],
    ['name' => 'h1']
];
$links = getLinks($tags);
[
    'hexlet.io/assets/logo.png',
    'hexlet.io/assets/style.css'
];
*/

namespace App\HTML;

// BEGIN (write your solution here)
function getLinks($tags)
{
    $arg = [
        'img' => 'src',
        'link' => 'href',
        'a' => 'href'
    ];
    $result = [];
    foreach ($tags as $item) {
        if (array_key_exists($item['name'], $arg)) {
            $result[] = $item[$arg[$item['name']]];
        }
    }
    return $result;
}
// END

// BEGIN
function getLinks($tags)
{
    $mapping = [
        'a' => 'href',
        'img' => 'src',
        'link' => 'href'
    ];

    $filteredTags = array_filter($tags, function ($tag) use ($mapping) {
        return in_array($tag['name'], array_keys($mapping));
    });

    $paths = array_map(function ($tag) use ($mapping) {
        $attributeName = $mapping[$tag['name']];
        return $tag[$attributeName];
    }, $filteredTags);
    return array_values($paths);
}
// END