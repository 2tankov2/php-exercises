<?php
/**
 * Реализуйте класс Circle для описания кругов. У круга есть только одно свойство - его радиус. Реализуйте методы
 * getArea и getCircumference, которые возвращают площадь и периметр круга соответственно.

<?php

$circle = new Circle(10);
 */
namespace App;

// BEGIN
class Circle
{
    private $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function getArea()
    {
        return pi() * ($this->radius ** 2);
    }

    public function getCircumference()
    {
        return 2 * pi() * $this->radius;
    }
}
// END