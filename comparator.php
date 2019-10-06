<?php
/**
 * Реализуйте функцию compare($seq1, $seq2), которая сравнивает две строчки набранные в редакторе. Если они равны,
 *  то возвращает true, иначе - false. Особенность строчек в том они могут содержать символ #, соответствующий нажатию
 * клавиши Backspace. Она означает, что нужно стереть предыдущий символ: abd##a# превращается в a.

<?php

 * Перед самим сравнением, нужно вычислить реальную строчку отображенную в редакторе.
// 'ac' === 'ac'
compare('ab#c', 'ab#c'); // true

// '' === ''
compare('ab##', 'c#d#'); // true

// 'a' === 'b'
compare('a#c', 'b'); // false

// 'cd' === 'cd'
compare('#cd', 'cd'); // true
 * Подсказки
 * Поведение # соответствует тому как это происходит в реальной жизни. Если строчка пустая, то Backspace ничего не стирает.
 * В этой задаче понадобится стек.
 * Воспользуйтесь классом \Ds\Stack.
 */
namespace App\Comparator;

// BEGIN
function compare($text1, $text2)
{
    $evaluatedText1 = evaluate($text1);
    $evaluatedText2 = evaluate($text2);

    return $evaluatedText1 === $evaluatedText2;
}

function evaluate($text)
{
    $stack = new \Ds\Stack();
    for ($i = 0, $length = mb_strlen($text); $i < $length; $i++) {
        $current = $text[$i];
        if ($current == '#') {
            if (!$stack->isEmpty()) {
                $stack->pop();
            }
        } else {
            $stack->push($current);
        }
    }

    return implode('', $stack->toArray());
}
// END