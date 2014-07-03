<?php
namespace Chadicus\Enum;

/**
 * Unit tests for the Chadicus\Enum\Month class.
 *
 * @coversDefaultClass \Chadicus\Enum\Month
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
     * @expectedExceptionMessage 'Invalid' is not a valid Chadicus\Enum\Month
     *
     * @return void
     */
    public function badConstant()
    {
        Month::Invalid();
    }
}
