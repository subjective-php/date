<?php
namespace SubjectivePHPTest\Util;

use DomainException;
use SubjectivePHP\Util\DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the SubjectivePHP\Util\DateTime class.
 *
 * @coversDefaultClass \SubjectivePHP\Util\DateTime
 * @covers ::<private>
 */
final class DateTimeTest extends TestCase
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
        $this->expectException(DomainException::class);
        $currentDateTime = new \DateTime('now');
        $startDateTime = new \DateTime('next year');
        $endDateTime = new \DateTime('last year');
        DateTime::isInRange($currentDateTime, $startDateTime, $endDateTime);
    }

    /**
     * Verify basic behavior of asAgoString().
     *
     * @test
     * @covers ::asAgoString
     * @dataProvider provideAgoStringData
     *
     * @param string $dateTimeString    The date/time string.
     * @param string $expectedAgoString The expected ago string.
     *
     * @return void
     */
    public function asAgoString($dateTimeString, $expectedAgoString)
    {
        $this->assertSame($expectedAgoString, DateTime::asAgoString(new \DateTime($dateTimeString)));
    }

    /**
     * Returns data for the asAgoString test.
     *
     * @return array
     */
    public function provideAgoStringData()
    {
        return [
            [ '-1 minute', 'just now'],
            [ '-2 minutes', '2 minutes ago'],
            [ '-30 minutes', 'about an hour ago'],
            [ '-10 hours', 'about 10 hours ago'],
            [ '-25 hours', 'yesterday'],
            [ '-3 days', 'about 3 days ago'],
            [ '-8 days', 'last week'],
            [ '-3 weeks', 'about 3 weeks ago'],
            [ '-1 month', 'last month' ],
            [ '-2 months', 'about 2 months ago' ],
            [ '-12 months', 'last year' ],
            [ '-1 year', 'last year' ],
            [ '-4 years', 'about 4 years ago' ],
        ];
    }

    /**
     * Verify error behavior of asAgoString().
     *
     * @test
     * @covers ::asAgoString
     *
     * @return void
     */
    public function asAgoStringWithFutureDate()
    {
        $this->expectException(DomainException::class);
        DateTime::asAgoString(new \DateTime('tomorrow'));
    }
}
