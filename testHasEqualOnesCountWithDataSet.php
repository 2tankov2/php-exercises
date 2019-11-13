<?php

/**
 * TestSolution.php
 * Напишите тесты на функцию hasEqualOnesCount, которая
 * принимает на вход два числа и возвращает true если количество
 * единиц в двоичном представлении у этих чисел совпадает и false если не совпадает.
 */

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    // BEGIN (write your solution here)
    /**
    * @dataProvider additionProvider
    */
    public function testHasEqualOnesCount($expected, $first, $second)
    {
        $this->assertEquals($expected, \App\hasEqualOnesCount($first, $second));
    }

    public function additionProvider()
    {
        return [
            [true, 7, 7],
            [false, 0, 2],
            [false, -37, 27],
            [true, 0, 0],
            [false, '1', -1],
            [true, 00001, 01000]
        ];
    }
    // END
}