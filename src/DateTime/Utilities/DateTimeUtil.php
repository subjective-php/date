<?php

namespace SubjectivePHP\DateTime\Utilities;

use DateTimeInterface;
use SubjectivePHP\DateTime\Constants\DayOfWeekInterface;

/**
 * Utility class for DateTimeInterface objects.
 */
abstract class DateTimeUtil implements DayOfWeekInterface
{
    /**
     * Returns true if the given date time is a Saturday or Sunday.
     *
     * @param DateTimeInterface $dateTime The date/time object.
     *
     * @return bool
     */
    final public static function isWeekendDay(DateTimeInterface $dateTime) : bool
    {
        return (int)$dateTime->format('N') > (int)self::ISO_FRIDAY;
    }

    /**
     * Returns true if the given date time is not a Saturday or Sunday.
     *
     * @param DateTimeInterface $dateTime The date/time object.
     *
     * @return bool
     */
    final public static function isWeekDay(DateTimeInterface $dateTime) : bool
    {
        return (int)$dateTime->format('N') < (int)self::ISO_SATURDAY;
    }

    /**
     * Returns true if the given dates occur on the same year, month and day.
     *
     * @param DateTimeInterface $thisDate A date to compare.
     * @param DateTimeInterface $thatDate A date to compare.
     *
     * @return bool
     */
    final public static function isSameDay(DateTimeInterface $thisDate, DateTimeInterface $thatDate) : bool
    {
        $interval = $thisDate->diff($thatDate);
        return !$interval->y && !$interval->m && !$interval->d;
    }

    /**
     * Indicates whether the given instance of DateTime is within the daylight saving time range for the current time
     * zone.
     *
     * @param DateTimeInterface $dateTime The date/time object.
     *
     * @return bool
     */
    final public static function isDaylightSavings(DateTimeInterface $dateTime) : bool
    {
        return (bool)$dateTime->format('I');
    }

    /**
     * Returns true if the given date is between the provided date range.
     *
     * @param DateTimeInterface $subjectDate The date/time object being checked.
     * @param DateTimeInterface $startDate   The start date/time object.
     * @param DateTimeInterface $endDate     The end date/time object.
     *
     * @return bool
     *
     * @throws \DomainException Thrown when an invalid date range is provided.
     */
    final public static function isInRange(
        DateTimeInterface $subjectDate,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate
    ) : bool {
        $subjectTimestamp = $subjectDate->getTimestamp();
        $startDateTimestamp = $startDate->getTimestamp();
        $endDateTimestamp = $endDate->getTimestamp();
        if ($startDateTimestamp > $endDateTimestamp) {
            throw new \DomainException('Invalid date range provided.');
        }

        return ($subjectTimestamp >= $startDateTimestamp && $subjectTimestamp <= $endDateTimestamp);
    }

    /**
     * Returns the given DateTime instance as a "time ago" string.
     *
     * @param DateTimeInterface $dateTime The DateTime object to present as an ago string.
     *
     * @return string
     *
     * @throws \DomainException Thrown if the given $dateTime is in the future.
     */
    final public static function asAgoString(DateTimeInterface $dateTime) : string
    {
        $numHours = round((time() - $dateTime->getTimestamp())/3600, 2);
        if ($numHours < 0) {
            throw new \DomainException('Cannot create "time ago" string for a date in the future.');
        }

        $formulas = [
            '.025' => ['just now', 1],
            '.5' => ['%d minutes ago', 60],
            '1.5' => ['about an hour ago', 1],
            '24' => ['about %d hours ago', 1],
            '48' => ['yesterday', 1],
            '168' => ['about %d days ago', 1/24],
            '252' => ['last week', 1],
            '672' => ['about %d weeks ago', 1/168],
            '1080' => ['last month', 1],
            '8760' => ['about %d months ago', 1/672],
            '13140' => ['last year', 1],
        ];

        foreach ($formulas as $maxHours => list($format, $multiplier)) {
            if ($numHours < $maxHours) {
                return sprintf($format, round($numHours * $multiplier));
            }
        }

        return sprintf('about %s years ago', round($numHours/8064));
    }
}
