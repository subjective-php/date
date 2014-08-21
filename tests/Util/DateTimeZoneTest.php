<?php
namespace Chadicus\Util;

/**
 * Unit tests for the Chadicus\Util\DateTimeZone class.
 *
 * @coversDefaultClass \Chadicus\Util\DateTimeZone
 * @covers ::<private>
 */
final class DateTimeZoneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of getAbbreviationFromName().
     *
     * @test
     * @covers ::getAbbreviationFromName
     *
     * @return void
     */
    public function getAbbreviationFromName()
    {
        $this->assertSame('EDT', DateTimeZone::getAbbreviationFromName('America/New_York'));
    }

    /**
     * Verify basic behavior of getAbbreviation().
     *
     * @test
     * @covers ::getAbbreviation
     * @uses Chadicus\Util\DateTimeZone::getAbbreviationFromName
     *
     * @return void
     */
    public function getAbbreviation()
    {
        $this->assertSame('CDT', DateTimeZone::getAbbreviation(-21600, 0));
    }
}
