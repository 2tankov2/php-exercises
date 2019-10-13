<?php 

// src/Nrzi.php
// Реализуйте функцию decode, которая принимает cтроку в виде графического представления линейного сигнала и возвращает строку с бинарным кодом.

// Примеры использования:
// <?php

// $signal = '_|¯|____|¯|__|¯¯¯';
// decode($signal); // => '011000110100'

// $signal_2 = '|¯|___|¯¯¯¯¯|___|¯|_|¯';
// decode($signal_2); // => '110010000100111'

// $signal_3 = '¯|___|¯¯¯¯¯|___|¯|_|¯';
// decode($signal_3); // => '010010000100111'
// Подсказки
// Символ | в строке указывает на переключение сигнала и означает, что уровень сигнала в следующем такте, будет изменён на противоположный по сравнению с предыдущим.

// К сожалению, str_split умеет работать только с ASCII символами, поэтому для разделения строки на символы используйте конструкцию preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);, где $str - строка.

<?php

namespace App\Nrzi;

// BEGIN (write your solution here)
function decode($str)
{
    if ($str === '' || $str === '|') {
        return '';
    }
    $arr = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    $result = '';
    foreach ($arr as $key => $value) {
        if (($key !== 0 && $value === '¯' && $arr[$key - 1] === '|') || ($key !== 0 && $value === '_' && $arr[$key - 1] === '|')) {
            $result .= '1';
        } elseif ($arr[$key] === '|') {
            $result .= '';
        } else {
            $result .= '0';
        }
    }
    return $result;
}
// END

// BEGIN
function decode($str)
{
    $symbols = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);

    $mapped = array_map(function ($key) use ($symbols) {
        if ($symbols[$key] === '|') {
            return '|';
        }
        if ($key === 0) {
            return 0;
        }
        return $symbols[$key - 1] === '|' ? 1 : 0;
    }, array_keys($symbols));

    $filtered = array_filter($mapped, function ($item) {
        return $item !== '|';
    });

    return implode('', $filtered);
}
// END