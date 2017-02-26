<?php

namespace Omissis\ArrayFunctions\Tests;

use function Omissis\ArrayFunctions\get as array_get;
use function Omissis\ArrayFunctions\set as array_set;

class FunctionsTest extends \PHPUnit_Framework_TestCase
{
    private $default;
    private $flatArray;
    private $recursiveArray;

    public function __construct()
    {
        $this->default = 'fooBarBaz';
        $this->flatArray = ['foo' => 'bar'];
        $this->recursiveArray = ['foo' => ['bar' => 'baz']];
    }

    public function testAkhGetHit()
    {
        $this->assertEquals('bar', array_get($this->flatArray, 'foo'));
    }

    public function testAkhGetMiss()
    {
        $this->assertEquals($this->default, array_get($this->flatArray, 'bar', $this->default));
    }

    public function testAkhGetRecursiveHit()
    {
        $this->assertEquals('baz', array_get($this->recursiveArray, ['foo', 'bar']));
    }

    public function testAkhGetRecursiveMiss()
    {
        $this->assertEquals($this->default, array_get($this->recursiveArray, ['bar', 'baz'], $this->default));
        $this->assertEquals($this->default, array_get($this->recursiveArray, ['foo','bar','baz'], $this->default));
    }

    public function testAkhSet()
    {
        $array = [];

        array_set($array, 'foo', 'bar');

        $this->assertEquals('bar', $array['foo']);
    }

    public function testAkhSetRecursiveWithEmptyArray()
    {
        $array = [];

        array_set($array, ['foo', 'bar'], 'baz');

        $this->assertEquals('baz', $array['foo']['bar']);
    }

    public function testAkhSetRecursiveWithArrayWithSetKeys()
    {
        $array = ['foo' => ['bar' => 123]];

        array_set($array, ['foo', 'bar'], 'baz');

        $this->assertEquals('baz', $array['foo']['bar']);
    }
}
