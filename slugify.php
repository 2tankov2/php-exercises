<?php
/**
 * Слаг — часть адреса сайта, которая используется для идентификации ресурса в Человекопонятном виде.
 * Без слага /posts/3, со слагом /posts/my-super-post, где слаг это my-super-post. Слаг обычно генерируется
 * автоматически на основе названия ресурса, например статьи. На Хекслете слаги используются повсеместно.

* Функция, выполняющая трансляцию текста в слаг, есть и в библиотеке Funct:

<?php

\Funct\Strings\slugify('Global Thermonuclear Warfare'); // => 'global-thermonuclear-warfare'
\Funct\Strings\slugify('Crème brûlée'); // => 'creme-brulee'
src\Slugify.php
* Реализуйте функцию slugify самостоятельно, не прибегая к \Funct\Strings\slugify. Преобразования,
* которые она должна делать:

<?php

slugify(''); // ''
slugify('test'); // 'test'
slugify('test me'); // 'test-me'
slugify('La La la LA'); // 'la-la-la-la'
slugify('O la      lu'); // 'o-la-lu'
slugify(' yOu   '); // 'you'

 */
namespace App\Slugify;

use Funct\Strings;
use Funct\Collection;

// BEGIN (write your solution here)
function slugify($text)
{
    if (empty($text)) {
        return '';
    }
    $strLower = mb_strtolower($text);
    $arr = explode(' ', $strLower);
    $arrNew = [];
    foreach ($arr as $element) {
        if (!empty($element) || $element === false) {
            $arrNew[] = $element;
        }
    } $result = implode('-', $arrNew);
    return $result;
}
// END

// BEGIN
function slugify($text)
{
    $prepared = Strings\toLower($text);
    $parts = explode(' ', $prepared);
    $parts = Collection\compact($parts);
    return implode('-', $parts);
}
// END