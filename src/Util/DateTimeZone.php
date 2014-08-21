<?php
namespace Chadicus\Util;

/**
 * Utility class for \DateTimeZone objects.
 */
class DateTimeZone
{
    /**
     * Returns the timezone abbreviation from the given offset.
     *
     * @param integer $offset          Offset from GMT in seconds.
     * @param integer $daylightSavings Daylight saving time indicator.
     *
     * @return string
     */
    final public static function getAbbreviation($offset, $daylightSavings = -1)
    {
        return self::getAbbreviationFromName(timezone_name_from_abbr('', $offset, $daylightSavings));
    }

    /**
     * Returns the timezone abbreviation from the given offset.
     *
     * @param string $name Name of the Timezone, ex America/New_York.
     *
     * @return string
     */
    final public static function getAbbreviationFromName($name)
    {
        return (new \DateTime('now', new \DateTimeZone($name)))->format('T');
    }
}
