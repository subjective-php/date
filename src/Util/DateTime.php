<?php
namespace Chadicus\Util;

use Chadicus\Enum;

/**
 * Utility class for \DateTime objects.
 */
class DateTime
{
    /**
     * Returns the Day of the week for the given date time.
     *
     * @param \DateTime $dateTime The date/time object.
     *
     * @return Enum\DayOfWeek
     */
    final public static function getDayOfWeek(\DateTime $dateTime)
    {
        return call_user_func("\\Chadicus\\Enum\\DayOfWeek::{$dateTime->format('l')}");
    }

    /**
     * Returns the month for the given date time.
     *
     * @param \DateTime $dateTime The date/time object.
     *
     * @return Enum\Month
     */
    final public static function getMonth(\DateTime $dateTime)
    {
        return call_user_func("\\Chadicus\\Enum\\Month::{$dateTime->format('F')}");
    }

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
}
