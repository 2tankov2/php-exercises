<?php

class Point
{
    public $x;
    public $y;
}
// Создаем объект класса Point
$point = new Point();

// По умолчанию значения равны null
print_r($point->x); // => null
print_r($point->y); // => null

// Обратите внимание на синтаксис. Такой вызов неверный: $point->$x.
$point->x = 5;
$point->y = 10;

print_r($point->x); // => 5
print_r("\n");
print_r($point->y); // => 10
print_r("\n");
print_r($point);
class Circle
{
    public $center;
    public $radius;
}

$circle = new Circle();
$circle->radius = 5;
$circle->center = new Point();
$circle->center->x = 8;
$circle->center->y = 1;

print_r($circle->center->x); // => 5
print_r("\n");
print_r($circle->radius); // 
print_r("\n");
print_r($circle);
print_r("circle " . gettype($circle)); // object
print_r("\n");
print_r("point " . gettype($point));

namespace App\PointFunctions;

use App\Point;

// BEGIN (write your solution here)
function getMidpoint($point1, $point2)
{
    $point3X = ($point2->x + $point1->x) / 2;
    $point3Y = ($point2->y + $point1->y) / 2;
    $point3 = new Point();
    $point3->x = $point3X;
    $point3->y = $point3Y;
    return $point3;
}
// END