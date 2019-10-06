<?php
/**
 * Реализуйте тест CourseTest, проверяющий работоспособность метода getName класса Course.
 */

namespace App\Tests;

use App\Course;
use PHPUnit\Framework\TestCase;

// BEGIN (write your solution here)
class CourseTest extends TestCase
{
    public function testGetName()
    {
        $name = 'my super course';
        $course = new \App\Course($name);
        $this->assertEquals($name, $course->getName());
    }
}
// END

// Course.php

namespace App;

class Course
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

// Checker.php

namespace App;

use PHPUnit\Runner\AfterLastTestHook;
use App\Tests\CourseTest;

final class Checker implements AfterLastTestHook
{
    public function executeAfterLastTest(): void
    {
        $test = new CourseTest();
    }
}
