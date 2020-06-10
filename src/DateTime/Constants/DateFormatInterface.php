<?php

namespace SubjectivePHP\DateTime\Constants;

interface DateFormatInterface
{
    /**
     * @var string
     */
    const DATE_FORMAT_HTTP_HEADER = 'D, d M Y H:i:s T';

    /**
     * @var string
     */
    const DATE_FORMAT_ISO_8601 = 'c';

    /**
     * @var string
     */
    const DATE_FORMAT_LONG_DATE = 'l, F d, Y';

    /**
     * @var string
     */
    const DATE_FORMAT_LONG_TIME = 'H:i:s';

    /**
     * @var string
     */
    const DATE_FORMAT_RFC_2822 = 'r';

    /**
     * @var string
     */
    const DATE_FORMAT_SHORT_DATE = 'm/d/Y';

    /**
     * @var string
     */
    const DATE_FORMAT_SHORT_TIME = 'g:i A';

    /**
     * @var string
     */
    const DATE_FORMAT_SORTABLE_DATETIME = 'Y-m-d H:i:s';

    /**
     * @var string
     */
    const DATE_FORMAT_YEAR_MONTH = 'F Y';
}
