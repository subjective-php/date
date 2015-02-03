<?php
namespace ChadicusTest\Util;

use Chadicus\Util\DateTimeZone;

/**
 * @coversDefaultClass \Chadicus\Util\DateTimeZone
 * @covers ::<private>
 */
final class DateTimeZoneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of fromString()
     *
     * @test
     * @covers ::fromString
     *
     * @return void
     */
    public function fromString()
    {
        $timezone = DateTimeZone::fromString('Pacific/Honolulu');
        $this->assertSame('Pacific/Honolulu', $timezone->getName());
        $this->assertSame(-36000, $timezone->getOffset(new \DateTime('now', $timezone)));
    }

    /**
     * Verify behavior of fromString() with default timezone.
     *
     * @test
     * @covers ::fromString
     *
     * @return void
     */
    public function fromStringDefaultTimeZone()
    {
        $timezone = new \DateTimeZone('Pacific/Honolulu');
        $this->assertSame($timezone, DateTimeZone::fromString('Invalid', $timezone));
    }

    /**
     * Verify behavior of fromString() with invalid default timezone.
     *
     * @test
     * @covers ::fromString
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $default must be a \DateTimeZone or string
     *
     * @return void
     */
    public function fromStringInvalidDefaultTimeZone()
    {
        DateTimeZone::fromString('Invalid', false);
    }

    /**
     * Verify fromString() defaults to UTC on error.
     *
     * @test
     * @covers ::fromString
     *
     * @return void
     */
    public function fromStringWithInvalidAbbreviation()
    {
        $this->assertSame('UTC', DateTimeZone::fromString('NOT VALID')->getName());
    }

    /**
     * Verify fromString() correctly converts edge case timezones
     *
     * @test
     * @covers ::fromString
     * @dataProvider getOutliers
     *
     * @return void
     */
    public function fromStringOutliers($abbreviation, $expected)
    {
        $this->assertSame($expected, DateTimeZone::fromString($abbreviation)->getName());
    }

    /**
     * Dataprovider for outlier testing
     *
     * @return array
     */
    public function getOutliers()
    {
        return [
            ['WIB', 'Asia/Jakarta'],
            ['FET', 'Europe/Helsinki'],
            ['AEST', 'Australia/Tasmania'],
            ['AWST', 'Australia/West'],
            ['WITA', 'Asia/Makassar'],
            ['AEDT', 'Australia/Sydney'],
            ['ACDT', 'Australia/Adelaide'],
        ];
    }

    /**
     * Verify basic behavior of fromOffset()
     *
     * @test
     * @covers ::fromOffset
     * @uses \Chadicus\Util\DateTimeZone::fromString
     *
     * @return void
     */
    public function fromOffset()
    {
        $timezone = DateTimeZone::fromOffset(-36000, false);
        $this->assertSame('Pacific/Honolulu', $timezone->getName());
    }

    /**
     * Verify behavior of fromOffset() when $gmtOffset is not an integer.
     *
     * @test
     * @covers ::fromOffset
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $gmtOffset must be an integer
     *
     * @return void
     */
    public function fromOffsetInvalidOffsetValue()
    {
        DateTimeZone::fromOffset(false, false);
    }

    /**
     * Verify behavior of fromOffset() when $isDaylightSavings is not a boolean.
     *
     * @test
     * @covers ::fromOffset
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isDaylightSavings must be a boolean
     *
     * @return void
     */
    public function fromOffsetInvalidDSTValue()
    {
        DateTimeZone::fromOffset(-36000, 0);
    }
}
