<?php

namespace SubjectivePHPTest\DateTime\Utilities;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use SubjectivePHP\DateTime\Utilities\DateTimeZoneUtil;

/**
 * @coversDefaultClass \SubjectivePHP\DateTime\Utilities\DateTimeZoneUtil
 * @covers ::<private>
 */
final class DateTimeZoneUtilTest extends TestCase
{
    /**
     * Verify basic behavior of fromString()
     *
     * @test
     * @covers ::fromString
     */
    public function fromString()
    {
        $timezone = DateTimeZoneUtil::fromString(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU);
        $this->assertSame(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU, $timezone->getName());
        $this->assertSame(-36000, $timezone->getOffset(new DateTime('now', $timezone)));
    }

    /**
     * Verify behavior of fromString() with default timezone.
     *
     * @test
     * @covers ::fromString
     */
    public function fromStringDefaultTimeZone()
    {
        $timezone = new DateTimeZone(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU);
        $this->assertSame($timezone, DateTimeZoneUtil::fromString('Invalid', $timezone));
    }

    /**
     * Verify fromString() defaults to UTC on error.
     *
     * @test
     * @covers ::fromString
     */
    public function fromStringWithInvalidAbbreviation()
    {
        $this->assertNull(DateTimeZoneUtil::fromString('NOT VALID'));
    }

    /**
     * Verify fromString() correctly converts edge case timezones.
     *
     * @param string $abbreviation The abbreviation to tests.
     * @param string $expected     The expected result from the fromString() call.
     *
     * @test
     * @covers ::fromString
     * @dataProvider getOutliers
     */
    public function fromStringOutliers(string $abbreviation, string $expected)
    {
        if (timezone_name_from_abbr($abbreviation) !== false) {
            $this->markTestSkipped(
                "The timezone abbreviation '{$abbreviation}' is not considered an outlier on this system"
            );
            return;
        }

        $this->assertSame($expected, DateTimeZoneUtil::fromString($abbreviation)->getName());
    }

    /**
     * Dataprovider for outlier testing
     *
     * @return array
     */
    public function getOutliers() : array
    {
        return [
            ['WIB', DateTimeZoneUtil::TIMEZONE_ASIA_JAKARTA],
            ['FET', DateTimeZoneUtil::TIMEZONE_EUROPE_HELSINKI],
            ['AEST', DateTimeZoneUtil::TIMEZONE_AUSTRALIA_TASMANIA],
            ['AWST', DateTimeZoneUtil::TIMEZONE_AUSTRALIA_WEST],
            ['WITA', DateTimeZoneUtil::TIMEZONE_ASIA_MAKASSAR],
            ['AEDT', DateTimeZoneUtil::TIMEZONE_AUSTRALIA_SYDNEY],
            ['ACDT', DateTimeZoneUtil::TIMEZONE_AUSTRALIA_ADELAIDE],
        ];
    }

    /**
     * Verify basic behavior of fromOffset()
     *
     * @test
     * @covers ::fromOffset
     */
    public function fromOffset()
    {
        $timezone = DateTimeZoneUtil::fromOffset(-36000, false);
        $this->assertSame(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU, $timezone->getName());
    }

    /**
     * Verify basic behavior of getLongName().
     *
     * @test
     * @covers ::getLongName
     */
    public function getLongName()
    {
        $timezone = new DateTimeZone('HST');
        $this->assertSame(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU, DateTimeZoneUtil::getLongName($timezone));
    }

    /**
     * Verify basic behavior of getLongName().
     *
     * @test
     * @covers ::getLongName
     */
    public function getLongNameWithLongName()
    {
        $timezone = new DateTimeZone(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU);
        $this->assertSame(DateTimeZoneUtil::TIMEZONE_PACIFIC_HONOLULU, DateTimeZoneUtil::getLongName($timezone));
    }

    /**
     * Verify behavior of getLongName() with outlier.
     *
     * @test
     * @covers ::getLongName
     */
    public function getLongNameOutlier()
    {
        $timezone = new DateTimeZone(DateTimeZoneUtil::TIMEZONE_UTC);
        $this->assertSame(DateTimeZoneUtil::TIMEZONE_UTC, DateTimeZoneUtil::getLongName($timezone));
    }
}
