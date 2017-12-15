<?php

namespace Tests\TestCase;

use Tests\TestCase;

class ShortClosureTest extends TestCase
{
    public function testClosures()
    {
        $this->assertOneVariable('$x * 2');
        $this->assertOneVariable('$x ~> $x * 2');
        $this->assertOneVariable('($x) ~> $x * 2');
        $this->assertOneVariable('$x ~> {return $x * 2;}');
        $this->assertOneVariable('($x) ~> {return $x * 2;}');

        $this->assertTwoVariables('($v, $k) ~> $v == 2 && $k == 1');
        $this->assertTwoVariables('($v, $k) ~> {return $v == 2 && $k == 1;}');
        $this->assertTwoVariables('($v, $k) ~> {$v2 = $v * 2; $k2 = $k * 2; return $v2 == 4 && $k2 == 2;}');
    }

    // https://wiki.php.net/rfc/short_closures
    public function testRfc()
    {
        $this->assertCompiles('$x ~> $x * 2');
        $this->assertCompiles('$x ~> { return $x * 2;}');
        $this->assertCompiles('($x) ~> $x * 2');
        $this->assertCompiles('($x) ~> { return $x * 2; }');
        $this->assertCompiles('$x, $y ~> {$x + $y}');
        $this->assertCompiles('($x, $y) ~> $x + $y');
        $this->assertCompiles('($x, $y) ~> return $x + $y;');
        $this->assertCompiles('($x, $y) ~> { return $x + $y; }');
        $this->assertCompiles('~> 2 * 3;');
        $this->assertCompiles('() ~> 2 * 3;');
    }

    // ---------------------------------- private ----------------------------------------------------------------------

    private function assertOneVariable($code)
    {
        $actual = collect([1, 2, 3])->map(c($code))->toArray();
        $expected = [2, 4, 6];

        $this->assertTrue($actual === $expected);
    }

    private function assertTwoVariables($code)
    {
        $actual = collect([0 => 1, 1 => 2, 2 => 3])->last(c($code));
        $this->assertEquals(2, $actual);
    }

    private function assertCompiles($code)
    {
        c($code);

        $this->assertTrue(true);
    }
}