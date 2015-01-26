<?php
namespace Chadicus\Util;

/**
 * Utility class for \DateTime objects.
 */
class DateTime
{
    /**
     * Returns true if the given date time is a Saturday or Sunday.
     *
     * @param \DateTime $dateTime The date/time object.
     *
     * @return boolean
     */
    final public static function isWeekendDay(\DateTime $dateTime)
    {
        //ISO-8601 numeric representation of the day of the week, 1 (for Monday) through 7 (for Sunday)
        return $dateTime->format('N') > 5;
    }

    /**
     * Returns true if the given date time is not a Saturday or Sunday.
     *
     * @param \DateTime $dateTime The date/time object.
     *
     * @return boolean
     */
    final public static function isWeekDay(\DateTime $dateTime)
    {
        //ISO-8601 numeric representation of the day of the week, 1 (for Monday) through 7 (for Sunday)
        return $dateTime->format('N') < 6;
    }

    /**
     * Returns true if the given dates occur on the same year, month and day.
     *
     * @param \DateTime $thisDate A date to compare.
     * @param \DateTime $thatDate A date to compare.
     *
     * @return boolean
     */
    final public static function isSameDay(\DateTime $thisDate, \DateTime $thatDate)
    {
        $interval = $thisDate->diff($thatDate);
        return !$interval->y && !$interval->m && !$interval->d;
    }
}
