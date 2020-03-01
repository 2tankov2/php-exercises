<?php
/*
Реализуйте функцию getSameCount, которая считает количество общих уникальных элементов для двух массивов.
Аргументы:

  Первый массив
  Второй массив
*/
namespace App\Arrays;

// BEGIN (write your solution here)
function getSameCount($arrOne, $arrTwo)
{
    $result = 0;
    $arrOneuniq = array_unique($arrOne);
    $arrTwouniq = array_unique($arrTwo);
    foreach ($arrOneuniq as $element) {
        $result = in_array($element, $arrTwouniq, true) ? $result += 1 : $result;
    } return $result;
}
// END

// BEGIN
function getSameCount($coll1, $coll2)
{
    $count = 0;
    $uniqColl1 = array_unique($coll1);
    $uniqColl2 = array_unique($coll2);
    foreach ($uniqColl1 as $item1) {
        foreach ($uniqColl2 as $item2) {
            if ($item1 === $item2) {
                $count++;
            }
        }
    }

    return $count;
}
// END