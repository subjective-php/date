<?php
namespace SubjectivePHP\DateTime\Utilities;

use DateTimeZone;
use SubjectivePHP\DateTime\Constants\TimezonesInterface;

/**
 * Static utility class for working with DateTimeZone objects.
 */
abstract class DateTimeZoneUtil implements TimezonesInterface
{
    /**
     * @var array
     */
    const OUTLIERS = [
        'WIB' => self::TIMEZONE_ASIA_JAKARTA,  //Western Indonesian Time
        'FET' => self::TIMEZONE_EUROPE_HELSINKI, //Further-eastern European Time
        'AEST' => self::TIMEZONE_AUSTRALIA_TASMANIA, //Australia Eastern Standard Time
        'AWST' => self::TIMEZONE_AUSTRALIA_WEST, //Australia Western Standard Time
        'WITA' => self::TIMEZONE_ASIA_MAKASSAR,
        'AEDT' => self::TIMEZONE_AUSTRALIA_SYDNEY, //Australia Eastern Daylight Time
        'ACDT' => self::TIMEZONE_AUSTRALIA_ADELAIDE, //Australia Central Daylight Time
    ];

    /**
     * Returns a DateTimeZone instance for the give nameOrAbbreviation.
     *
     * @param string       $nameOrAbbreviation The timezone nameOrAbbreviation.
     * @param DateTimeZone $default            The default timezone to return if none can be created.
     *
     * @return DateTimeZone|null
     */
    final public static function fromString(string $nameOrAbbreviation, DateTimeZone $default = null)
    {
        try {
            return new DateTimeZone($nameOrAbbreviation);
        } catch (\Exception $e) {
            if (array_key_exists($nameOrAbbreviation, self::OUTLIERS)) {
                return new DateTimeZone(self::OUTLIERS[$nameOrAbbreviation]);
            }

            return $default;
        }
    }

    /**
     * Returns a DateTimeZone object based on gmt offset.
     *
     * @param int  $gmtOffset         Offset from GMT in seconds.
     * @param bool $isDaylightSavings Daylight saving time indicator.
     *
     * @return DateTimeZone
     */
    final public static function fromOffset(int $gmtOffset, bool $isDaylightSavings) : DateTimeZone
    {
        return self::fromString(timezone_name_from_abbr('', $gmtOffset, (int)$isDaylightSavings));
    }

    /**
     * Returns the long name of the given DateTimeZone.
     *
     * @param DateTimeZone $timezone The timezone object from which the long name should be obtained.
     *
     * @return string
     */
    final public static function getLongName(DateTimeZone $timezone) : string
    {
        $nameFromTimeZone = $timezone->getName();
        if (strlen($nameFromTimeZone) > 6) {
            return $nameFromTimeZone;
        }

        $nameFromAbbr = timezone_name_from_abbr($nameFromTimeZone);

        return $nameFromAbbr === false ? $nameFromTimeZone : $nameFromAbbr;
    }
}
