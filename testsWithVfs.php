<?php

/**
 * SolutionTest.php
 * Напишите тесты на функцию mkdirs, которая рекурсивно создает директории для переданного пути
 */

namespace App;

require getenv('COMPOSER_HOME') . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

// BEGIN (write your solution here)
use org\bovigo\vfs\vfsStream;
// END

class TestSolution extends TestCase
{
    // BEGIN (write your solution here)
    public function testMkdirs()
    {
        $root = vfsStream::setup('root');

        mkdirs(implode(DIRECTORY_SEPARATOR, [vfsStream::url('root'), 'test']));
        $this->assertTrue($root->hasChild('test'));

        mkdirs(implode(DIRECTORY_SEPARATOR, [vfsStream::url('root'), 'test', 'inner']));
        $this->assertTrue($root->hasChild(implode(DIRECTORY_SEPARATOR, ['test', 'inner'])));
    }
    // END
}
