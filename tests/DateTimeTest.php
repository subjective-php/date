<?php
namespace ChadicusTest\Util;

use Chadicus\Util\DateTime;
use Chadicus\Util\Helper\AgoHelper;

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

    /**
     * Verify basic behavior of isDaylightSavings().
     *
     * @test
     * @covers ::isDaylightSavings
     *
     * @return void
     */
    public function isDaylightSavings()
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('Pacific/Honolulu'));
        $this->assertFalse(DateTime::isDaylightSavings($dateTime));
    }

    /**
     * Verify basic behavior of isInRange().
     *
     * @test
     * @covers ::isInRange
     *
     * @return void
     */
    public function isInRange()
    {
        $currentDateTime = new \DateTime('now');
        $startDateTime = new \DateTime('last year');
        $endDateTime = new \DateTime('next year');
        $this->assertTrue(DateTime::isInRange($currentDateTime, $startDateTime, $endDateTime));
    }

    /**
     * Verify error behavior of isInRange().
     *
     * @test
     * @covers ::isInRange
     *
     * @return void
     */
    public function isInRangeWithInvalidRange()
    {
        $currentDateTime = new \DateTime('now');
        $startDateTime = new \DateTime('next year');
        $endDateTime = new \DateTime('last year');
        $this->setExpectedException('\DomainException');
        DateTime::isInRange($currentDateTime, $startDateTime, $endDateTime);
    }

    /**
     * Verify basic behavior of asAgoString().
     *
     * @test
     * @covers ::asAgoString
     *
     * @return void
     */
    public function asAgoString()
    {
        $dateTime = new \DateTime('yesterday');
        $this->assertSame(AgoHelper::getAgoString($dateTime), DateTime::asAgoString($dateTime));
    }
}
