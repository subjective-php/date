<?php
namespace Chadicus\DateTime\Enums;

/**
 * Unit tests for the Chadicus\DateTime\Enums\Month class.
 *
 * @coversDefaultClass \Chadicus\DateTime\Enums\Month
 * @covers ::<private>
 */
final class MonthTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of __callStatic.
     *
     * @test
     * @covers ::__callStatic
     * @covers ::__toString
     *
     * @return void
     */
    public function basicUse()
    {
        $this->assertSame(Month::JUNE, (string)Month::June());
    }

    /**
     * Verify exception is thrown if __callStatic is invoked with an invalid value.
     *
     * @test
     * @covers ::__callStatic
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage 'Invalid' is not a valid Chadicus\DateTime\Enums\Month
     *
     * @return void
     */
    public function badConstant()
    {
        Month::Invalid();
    }
}
