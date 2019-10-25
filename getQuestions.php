<?php

/**
 * src\Normalizer.php
 * Реализуйте функцию getQuestions, которая принимает на вход текст (полученный из редактора) и возвращает извлеченные
 * из этого текста вопросы. Это должна быть строчка в форме списка разделенных переводом строки вопросов (смотрите секцию
 * "Примеры").

 * Входящий текст разбит на строки и может содержать любые пробельные символы. Некоторые из этих строк являются
 * вопросами. Они определяются по последнему символу: если это знак ?, то считаем строку вопросом.

 * Примеры
<?php

$text = <<<HEREDOC
lala\r\nr
ehu?
vie?eii
\n \t
i see you
/r \n
one two?\r\n\n
HEREDOC;

$result = getQuestions($text); // "ehu?\none two?"
echo $result;
// ehu?
// one two?
 */

namespace App\Normalizer;

use function Stringy\create as s;

// BEGIN (write your solution here)
function getQuestions($text)
{
    $stringy = S($text)->lines();
    $result = [];
    foreach ($stringy as $str) {
        if (S($str)->endsWith('?')) {
            $result[] = $str;
        }
    }
    return implode("\n", $result);
}
// END

// BEGIN
function getQuestions(string $text)
{
    $lines = s($text)->lines();
    $filteredLines = collect($lines)->filter(function ($line) {
        return $line->endsWith('?');
    });
    return implode("\n", $filteredLines->all());
}
// END