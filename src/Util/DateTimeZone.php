<?php
namespace SubjectivePHP\Util;

use SubjectivePHP\DateTime\Utilities\DateTimeZoneUtil;

/**
 * @deprecated Will be removed in version 4
 */
abstract class DateTimeZone
{
    /**
     * Array of edge case timezones
     *
     * @var array
     */
    private static $outliers = [
        'WIB' => 'Asia/Jakarta',  //Western Indonesian Time
        'FET' => 'Europe/Helsinki', //Further-eastern European Time
        'AEST' => 'Australia/Tasmania', //Australia Eastern Standard Time
        'AWST' => 'Australia/West', //Australia Western Standard Time
        'WITA' => 'Asia/Makassar',
        'AEDT' => 'Australia/Sydney', //Australia Eastern Daylight Time
        'ACDT' => 'Australia/Adelaide', //Australia Central Daylight Time
    ];

    /**
     * Returns a \DateTimeZone instance for the give nameOrAbbreviation.
     *
     * @param string        $nameOrAbbreviation The timezone nameOrAbbreviation.
     * @param \DateTimeZone $default            The default timezone to return if none can be created.
     *
     * @return \DateTimeZone
     */
    final public static function fromString($nameOrAbbreviation, \DateTimeZone $default = null)
    {
        return DateTimeZoneUtil::fromString($nameOrAbbreviation, $default);
    }

    /**
     * Returns a \DateTimeZone object based on gmt offset.
     *
     * @param integer $gmtOffset         Offset from GMT in seconds.
     * @param boolean $isDaylightSavings Daylight saving time indicator.
     *
     * @return \DateTimeZone
     *
     * @throws \InvalidArgumentException Thrown if $gmtOffset is not an integer.
     * @throws \InvalidArgumentException Thrown if $isDaylightSavings is not a boolean.
     */
    final public static function fromOffset($gmtOffset, $isDaylightSavings)
    {
        if (!is_int($gmtOffset)) {
            throw new \InvalidArgumentException('$gmtOffset must be an integer');
        }

        if (!is_bool($isDaylightSavings)) {
            throw new \InvalidArgumentException('$isDaylightSavings must be a boolean');
        }

        return DateTimeZoneUtil::fromString(timezone_name_from_abbr('', $gmtOffset, (int)$isDaylightSavings));
    }

    /**
     * Returns the long name of the given \DateTimeZone.
     *
     * @param \DateTimeZone $timezone The timezone object from which the long name should be obtained.
     *
     * @return string
     */
    final public static function getLongName(\DateTimeZone $timezone)
    {
        return DateTimeZoneUtil::getLongName($timezone);
    }
}
