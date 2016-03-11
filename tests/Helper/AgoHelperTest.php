<?php
namespace ChadicusTest\Util\Helper;

use Chadicus\Util\Helper\AgoHelper;

/**
 * Unit tests for the Chadicus\Util\Helper\AgoHelper class.
 *
 * @coversDefaultClass \Chadicus\Util\Helper\AgoHelper
 * @covers ::<private>
 */
class AgoHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of getAgoString().
     *
     * @test
     * @covers ::getAgoString
     * @dataProvider provideAgoStringData
     *
     * @param string $dateTimeString    The date/time string.
     * @param string $expectedAgoString The expected ago string.
     *
     * @return void
     */
    public function getAgoString($dateTimeString, $expectedAgoString)
    {
        $this->assertSame($expectedAgoString, AgoHelper::getAgoString(new \DateTime($dateTimeString)));
    }

    /**
     * Returns data for the getAgoString test.
     *
     * @return array
     */
    public function provideAgoStringData()
    {
        return [
            [ '-1 minute', 'just now'],
            [ '-2 minutes', '2 minutes ago'],
            [ '-30 minutes', 'about an hour ago'],
            [ '-10 hours', 'about 10 hours ago'],
            [ '-25 hours', 'yesterday'],
            [ '-3 days', 'about 3 days ago'],
            [ '-8 days', 'last week'],
            [ '-3 weeks', 'about 3 weeks ago'],
            [ '-1 month', 'last month' ],
            [ '-2 months', 'about 2 months ago' ],
            [ '-12 months', 'last year' ],
            [ '-1 year', 'last year' ],
            [ '-4 years', 'about 4 years ago' ],
        ];
    }

    /**
     * Verify error behavior of getAgoString().
     *
     * @test
     * @covers ::getAgoString
     *
     * @return void
     */
    public function getAgoStringWithFutureDate()
    {
        $this->setExpectedException('\DomainException');
        AgoHelper::getAgoString(new \DateTime('tomorrow'));
    }
}
