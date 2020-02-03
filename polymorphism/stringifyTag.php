<?php

/**
src\HTML.php
* Реализуйте функцию stringify($tag), которая принимает на вход тег и возвращает его текстовое представление.
* Например:

<?php

use function App\HTML\stringify;

$tag = ['name' => 'hr', 'class' => 'px-3', 'id' => 'myid', 'tagType' => 'single'];
$html = stringify($tag);
// <hr class="px-3" id="myid">


$tag = ['name' => 'div', 'tagType' => 'pair', 'body' => 'text2', 'id' => 'wow'];
$html = stringify($tag);
// <div id="wow">text2</div>
* Внутри структуры тега есть три специальных ключа:

* name - имя тега
* tagType - тип тега, определяет его парность (pair) или одиночность (single)
* body - тело тега, используется для парных тегов
* Все остальное становится атрибутами тега и не зависит от того парный он или нет.
*/

<?php

namespace App\HTML;

// BEGIN (write your solution here)
function render1($data)
{
    $result = '';
    $result .= '<' . $data['name'];
    $result .= array_key_exists('class', $data) ? ' ' . 'class="' . $data['class'] . '"' : '';
    $result .= array_key_exists('id', $data) ? ' ' . 'id="' . $data['id'] . '"' : '';
    $result .= '>';
    $result .= array_key_exists('body', $data) ? $data['body'] : '';
    $result .= '</' . $data['name'] . '>';
    return $result;
}

function render2($data)
{
    $result = '';
    $result .= '<' . $data['name'];
    $result .= array_key_exists('class', $data) ? ' ' . 'class="' . $data['class'] . '"' : '';
    $result .= array_key_exists('id', $data) ? ' ' . 'id="' . $data['id'] . '"' : '';
    $result .= '>';
    return $result;
}

function stringify($tag)
{
    $type = $tag['tagType'];
    $mapping = [
        'pair' => function ($rawTag) {
            return render1($rawTag);
        },
        'single' => function ($rawTag) {
            return render2($rawTag);
        }
    ];
    return $mapping[$type]($tag);
}
// END

// BEGIN
function buildAttrs(array $tag)
{
    return collect($tag)
        ->except(['name', 'tagType', 'body'])
        ->map(function ($value, $key) {
            return " {$key}=\"{$value}\"";
        })->join('');
}

function stringify($tag)
{
    $mapping = [
        'single' => function ($tag) {
            $attrs = buildAttrs($tag);
            return "<{$tag['name']}{$attrs}>";
        },
        'pair' => function ($tag) {
            $attrs = buildAttrs($tag);
            return "<{$tag['name']}{$attrs}>{$tag['body']}</{$tag['name']}>";
        }
    ];

    $build = $mapping[$tag['tagType']];
    return $build($tag);
}
// END
