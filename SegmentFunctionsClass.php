<?php

/**
 * src/Segment.php
 * Реализуйте класс App\Segment с двумя публичными свойствами beginPoint и endPoint. Определите в классе конструктор.

 * Примеры
<?php

$segment = new Segment(new Point(1, 1), new Point(10, 11));
src/SegmentFunctions.php
 * Реализуйте функцию reverse, которая принимает на вход сегмент и возвращает новый сегмент с точками, добавленными в
 * обратном порядке (begin меняется местами с end).

 * Примечания
 * Точки в результирующем сегменте должны быть копиями (по значению) соответствующих точек исходного массива. То есть
 * они не должны быть ссылкой на один и тот же объект, так как это разные объекты (пускай и с одинаковыми координатами).
 * Примеры
<?php

use function App\SegmentFunctions\reverse;

$segment = new \App\Segment(new Point(1, 10), new Point(11, -3));
$reversedSegment = reverse($segment);

$reversedSegment->beginPoint; // => (11, -3)
$reversedSegment->endPoint; // => (1, 10)
 */

// src/Point.php

<?php

namespace App;

class Point
{
    public $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

// src/Segment.php

<?php

namespace App;

// BEGIN (write your solution here)
class Segment
{
    public $beginPoint;
    public $endPoint;

    public function __construct($beginPoint, $endPoint)
    {
        $this->beginPoint = $beginPoint;
        $this->endPoint = $endPoint;
    }
}
// END

// src/SegmentFunctions.php

<?php

namespace App\SegmentFunctions;

use App\Point;
use App\Segment;

// BEGIN (write your solution here)
function reverse($segment)
{
    $begin = $segment->endPoint;
    $end = $segment->beginPoint;
    $beginX = $begin->x;
    $beginY = $begin->y;
    $endX = $end->x;
    $endY = $end->y;
    $beginPoint = new Point($beginX, $beginY);
    $endPoint = new Point($endX, $endY);
    $newSegment = new Segment($beginPoint, $endPoint);
    return $newSegment;
}
// END

// BEGIN
function reverse($segment)
{

    $startP = $segment->beginPoint;
    $finishP = $segment->endPoint;
    $endPoint = new Point($startP->x, $startP->y);
    $beginPoint = new Point($finishP->x, $finishP->y);

    return new \App\Segment($beginPoint, $endPoint);
}
// END