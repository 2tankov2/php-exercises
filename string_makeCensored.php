<?php
/* 
Реализуйте функцию makeCensored, которая заменяет каждое вхождение указанных слов в предложении на 
последовательность $#%! и возвращает полученную строку. Аргументы:

  Текст
  Набор стоп слов
Словом считается любая непрерывная последовательность символов, включая любые спецсимволы (без пробелов).
*/

namespace App\Strings;

// BEGIN (write your solution here)
function makeCensored($text, $stopWords)
{
    $result = [];
    $words = explode(' ', $text);
    foreach ($words as $word) {
        $result[] = in_array($word, $stopWords) ? '$#%!' : $word;
    } return implode(' ', $result);
}
// END
