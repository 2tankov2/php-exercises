<?php

// src\Arrays.php
// Реализуйте функцию enlargeArrayImage, которая принимает изображение в виде двумерного массива и увеличивает его в два раза.

// <?php

// $arr = [
//     ['*','*','*','*'],
//     ['*',' ',' ','*'],
//     ['*',' ',' ','*'],
//     ['*','*','*','*']
// ];
// // ****
// // *  *
// // *  *
// // ****

// enlargeArrayImage($arr);
// // ********
// // ********
// // **    **
// // **    **
// // **    **
// // **    **
// // ********
// // ********



namespace App\Arrays;

// BEGIN (write your solution here)
function enlargeArrayImage($data)
{
    $row = array_reduce($data, function ($acc, $item) {
        $col = array_reduce($item, function ($acum, $value) {
            $acum[] = $value;
            $acum[] = $value;
            return $acum;
        });
        $acc[] = $col;
        $acc[] = $col;
        return $acc;
    }, []);
    return $row;
}
// END

// BEGIN
function enlargeArrayImage($arr)
{
    $result = [];

    foreach ($arr as $child) {
        $childArray = [];
        foreach ($child as $symbol) {
            $childArray[] = $symbol;
            $childArray[] = $symbol;
        }
        $result[] = $childArray;
        $result[] = $childArray;
    }

    return $result;
}

// ALTERNATIVE SOLUTION
// function duplicateEachItemInArray($arr)
// {
//   // create subarrays for each value
//   $arrayOfArraysOfTwoItems = array_map(function ($a) {
//     return [$a, $a];
//   }, $arr);

//   // flatten
//   return call_user_func_array('array_merge', $arrayOfArraysOfTwoItems);
// }

// function enlargeArrayImage($arr)
// {
//   $verticallyStretched = array_map("App\Arrays\duplicateEachItemInArray", $arr);
//   return duplicateEachItemInArray($verticallyStretched);
// }
// END