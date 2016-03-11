<?php
namespace Chadicus\Util\Helper;

/**
 * Helper class for building "time ago" strings.
 */
class AgoHelper
{
    /**
     * Returns the date/time as a "time ago" string.
     *
     * @param \DateTime $dateTime The date/time object.
     *
     * @return string
     * @throws \DomainException Thrown when a future date is provided.
     */
    final public static function getAgoString(\DateTime $dateTime)
    {
        $currentTimestamp = time();
        $subjectTimestamp = $dateTime->getTimestamp();
        if ($subjectTimestamp > $currentTimestamp) {
            throw new \DomainException('Cannot create "time ago" string for a date in the future.');
        }
        $numHours = round(($currentTimestamp - $subjectTimestamp)/3600, 2);
        return self::buildAgoString($numHours);
    }

    /**
     * Creates a "time ago" string.
     *
     * @param float $numHours A number of hours.
     * @return string
     */
    private static function buildAgoString($numHours)
    {
        $formats = self::getFormats();
        $callbacks = self::getCallbacks();
        foreach ($formats as $maxNumHours => $format) {
            if ($numHours >= $maxNumHours) {
                continue;
            }
            if (array_key_exists($maxNumHours, $callbacks)) {
                return sprintf($format, $callbacks[$maxNumHours]($numHours));
            }
            return $format;
        }
        return sprintf('about %s years ago', round($numHours/(24*7*4*12)));
    }

    /**
     * Returns the string format for creating a "time ago" string.
     *
     * @return array
     */
    private static function getFormats()
    {
        return [
            '.025'    => 'just now',
            '.5'      => '%d minutes ago',
            '1.5'     => 'about an hour ago',
            '24'      => 'about %d hours ago',
            '48'      => 'yesterday',
            '168'     => 'about %d days ago',
            '252'     => 'last week',
            '672'     => 'about %d weeks ago',
            '1080'    => 'last month',
            '8760'    => 'about %d months ago',
            '13140'   => 'last year',
        ];
    }

    /**
     * Returns the callback needed to calculate the numeric portion of a "time ago" string.
     *
     * @return array
     */
    private static function getCallbacks()
    {
        return [
            '.5' => function ($a) {
                return round($a * 60);
            },
            '24' => function ($a) {
                return $a;
            },
            '168' => function ($a) {
                return round($a / 24);
            },
            '672' => function ($a) {
                return round($a / (24 * 7));
            },
            '8760' => function ($a) {
                return $a / (24 * 7 * 4);
            }
        ];
    }
}
