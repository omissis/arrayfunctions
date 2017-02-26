<?php

namespace Omissis\ArrayFunctions\Tests;

use Omissis\ArrayFunctions\ArrayFunctions as Arr;

class ArrayFunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $array = ['foo' => 'bar'];

        $this->assertSame('bar', Arr::get($array, 'foo'));
    }

    public function testSet()
    {
        $array = ['foo' => 'bar'];

        $this->assertSame('bar', Arr::set($array, 'foo', 'baz'));
        $this->assertSame('baz', Arr::get($array, 'foo'));
    }
}
