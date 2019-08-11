<?php

namespace App\Solution;
/**
 * ДНК и РНК это последовательности нуклеотидов.

 * Четыре нуклеотида в ДНК это аденин (A), цитозин (C), гуанин (G) и тимин (T).

 * Четыре нуклеотида в РНК это аденин (A), цитозин (C), гуанин (G) и урацил (U).

 * Цепь РНК составляется на основе цепи ДНК последовательной заменой каждого нуклеотида:

 * G -> C
 * C -> G
 * T -> A
 * A -> U
 * Напишите функцию toRna, которая принимает на вход цепь ДНК и возвращает соответствующую цепь
 * РНК (совершает транскрипцию РНК).

<?php

toRna('ACGTGGTCTTAA');
// → 'UGCACCAGAAUU'
 */
// BEGIN (write your solution here)

function toRna($text)
{
    $dnk = [
    'G' => 'C',
    'C' => 'G',
    'T' => 'A',
    'A' => 'U'
    ];
    $arr = str_split($text);
    $result = [];
    foreach ($arr as $value) {
        $result[] = $dnk[$value];
    }
    return implode('', $result);
}
// END

// BEGIN
function toRna(String $nucleotide)
{
    $map = [
        'G' => 'C',
        'C' => 'G',
        'T' => 'A',
        'A' => 'U',
    ];

    $length = strlen($nucleotide);

    $result = [];
    for ($i = 0; $i < $length; $i += 1) {
        $result[] = $map[$nucleotide[$i]];
    }

    return implode('', $result);
}
// END