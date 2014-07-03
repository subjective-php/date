<?php
namespace Chadicus\Util;

/**
 * Unit tests for the Chadicus\Util\DateTime class.
 *
 * @coversDefaultClass \Chadicus\Util\DateTime
 * @covers ::<private>
 */
final class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of getDayOfWeek().
     *
     * @test
     * @covers ::getDayOfWeek
     * @uses \Chadicus\Enum\AbstractEnum
     *
     * @return void
     */
    public function getDayOfWeek()
    {
        $dayOfWeek = DateTime::getDayOfWeek(new \DateTime('2014-07-03'));
        $this->assertInstanceOf('\\Chadicus\\Enum\\DayOfWeek', $dayOfWeek);
        $this->assertSame(\Chadicus\Enum\DayOfWeek::THURSDAY, (string)$dayOfWeek);
    }

    /**
     * Verify basic behavior of getMonth().
     *
     * @test
     * @covers ::getMonth
     * @uses \Chadicus\Enum\AbstractEnum
     *
     * @return void
     */
    public function getMonth()
    {
        $month = DateTime::getMonth(new \DateTime('2014-07-03'));
        $this->assertInstanceOf('\\Chadicus\\Enum\\Month', $month);
        $this->assertSame(\Chadicus\Enum\Month::JULY, (string)$month);
    }

    /**
     * Verify basic behavior of isWeekDay().
     *
     * @test
     * @covers ::isWeekDay
     *
     * @return void
     */
    public function isWeekDay()
    {
        $this->assertTrue(DateTime::isWeekDay(new \DateTime('2014-07-02')));
        $this->assertFalse(DateTime::isWeekDay(new \DateTime('2014-07-05')));
    }

    /**
     * Verify basic behavior of isWeekendDay().
     *
     * @test
     * @covers ::isWeekendDay
     *
     * @return void
     */
    public function isWeekendDay()
    {
        $this->assertFalse(DateTime::isWeekendDay(new \DateTime('2014-07-02')));
        $this->assertTrue(DateTime::isWeekendDay(new \DateTime('2014-07-05')));
    }
}
