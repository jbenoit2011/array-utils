<?php

namespace GuestToGuest\Tests\Core\Unit\Common;

use ArrayUtils\ArrayUtils;
use PHPUnit_Framework_TestCase;

class ArrayUtilsTest extends PHPUnit_Framework_TestCase
{
    public function testCartesianProduct()
    {
        $product = ArrayUtils::cartesianProduct([
            [1, 2],
            [3, 4]
        ]);

        $this->assertContains([1, 3], $product);
        $this->assertContains([1, 4], $product);
        $this->assertContains([2, 3], $product);
        $this->assertContains([2, 4], $product);
    }

    public function testPluck()
    {
        $plucked = ArrayUtils::pluck('foo', [
            ['foo' => 1],
            ['foo' => 2],
        ]);

        $this->assertEquals([1, 2], $plucked);
    }

    public function testFlatten()
    {
        $flatten = ArrayUtils::flatten([
            [1]
        ]);

        $this->assertEquals([1], $flatten);
    }

    public function testXrangeBounds()
    {
        $range = ArrayUtils::xrange(0, 2);
        $this->assertEquals(0, $range->current());
        $range->next();
        $range->next();
        $this->assertEquals(2, $range->current());
    }

    public function testXrangeStep()
    {
        $range = ArrayUtils::xrange(0, 2, 2);
        $this->assertEquals(0, $range->current());

        $range->next();
        $this->assertEquals(2, $range->current());
    }
}
