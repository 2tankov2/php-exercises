<?php
// Реализуйте функцию getIntersectionOfSortedArray, которая принимает на вход два отсортированных массива и находит их пересечение.

namespace App\Arrays;

function getIntersectionOfSortedArray($arr1, $arr2)
{
     // BEGIN (write your solution here)
     $size1 = count($arr1);
     $size2 = count($arr2);
     
     if ($size1 === 0 || $size2 === 0) {
         return [];
     } $i = 0;
       $arr = [];
         do {
             if (in_array($arr1[$i], $arr2)) {
                 array_push($arr, $arr1[$i]);
             } $i++;
         } while ($i < $size1);
     return array_unique($arr);
     // END
 }

 // BEGIN
 $size1 = count($arr1);
 $size2 = count($arr2);

 if ($size1 == 0 || $size2 == 0) {
     return [];
 }

 $i1 = 0;
 $i2 = 0;
 $result = [];
 do {
     if ($arr1[$i1] == $arr2[$i2]) {
         $result[] = $arr1[$i1];
         $i1++;
         $i2++;
     } elseif ($arr1[$i1] > $arr2[$i2]) {
         $i2++;
     } else {
         $i1++;
     }
 } while ($i1 < $size1 && $i2 < $size2);

 return $result;
 // END