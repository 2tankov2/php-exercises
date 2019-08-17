<?php
/**
 * Реализуйте функцию __toString, которая преобразует сегмент к строке в соответствии с примером ниже [(1, 10)]

<?php

$point1 = new Point(1, 10);
$point2 = new Point(11, -3);
$segment1 = new Segment($point1, $point2);
echo $segment1; // => [(1, 10), (11, -3)]

$segment2 = new Segment($point2, $point1);
echo $segment2; // => [(11, -3), (1, 10)]
 */
// Segment.php
namespace App;

class Segment
{
    private $beginPoint;
    private $endPoint;

    public function __construct($beginPoint, $endPoint)
    {
        $this->beginPoint = $beginPoint;
        $this->endPoint = $endPoint;
    }

    // BEGIN (write your solution here)
    public function __toString()
    {
        return "[{$this->beginPoint}, {$this->endPoint}]";
    }
    // END
}

// Point.php

<?php

namespace App;

class Point
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString()
    {
        return "({$this->x}, {$this->y})";
    }
}
