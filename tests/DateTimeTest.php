<?php
namespace ChadicusTest\Util;

use Chadicus\Util\DateTime;

/**
 * Unit tests for the Chadicus\Util\DateTime class.
 *
 * @coversDefaultClass \Chadicus\Util\DateTime
 * @covers ::<private>
 */
final class DateTimeTest extends \PHPUnit_Framework_TestCase
{
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

    /**
     * Verify basic behavior of isSameDay().
     *
     * @test
     * @covers ::isSameDay
     *
     * @return void
     */
    public function isSameDay()
    {
        $thisDate = new \DateTime('2015-01-01 12:00:00', new \DateTimeZone('Pacific/Fiji'));
        $thatDate = new \DateTime('2014-12-31 12:00:00', new \DateTimeZone('America/New_York'));

        $this->assertNotEquals($thisDate->format('Y-m-d'), $thatDate->format('Y-m-d'));
        $this->assertTrue(DateTime::isSameDay($thisDate, $thatDate));
    }
}
