<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2020 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\DI\Test\HTTP\URL;

use DateTimeInterface;
use doganoo\DI\DateTime\IDateTimeService;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\DateTime\DateTimeService;

class DateTimeServiceTest extends TestCase {

    /** @var IDateTimeService */
    private $dateTimeService;

    /**
     * @param int $timestamp
     *
     * @dataProvider getTimestamps
     */
    public function testFromTimestamp(int $timestamp) {
        $dateTime = $this->dateTimeService->toDateTime($timestamp);
        $this->assertTrue($dateTime instanceof DateTimeInterface);
        $this->assertTrue($dateTime->getTimestamp() === $timestamp);
    }

    /**
     * @param int $start
     * @param int $end
     * @param int $days
     * @dataProvider getDateTimeDifferences
     */
    public function testDateDifference(int $start, int $end, int $days) {
        $daysCalculated = $this->dateTimeService->getDifference(
            $this->dateTimeService->toDateTime($start)
            , $this->dateTimeService->toDateTime($end)
        );
        $this->assertTrue($daysCalculated === $days);
    }

    /**
     * @param string $format
     * @param bool   $isNull
     *
     * @dataProvider getFormattedTimestamps
     */
    public function testFromFormat(string $format, bool $isNull) {
        $dateTime = $this->dateTimeService->fromFormat($format);

        if (true === $isNull) {
            $this->assertNull($dateTime);
        } else {
            $this->assertTrue($dateTime instanceof DateTimeInterface);
            $this->assertTrue($dateTime->getTimestamp() === strtotime($format));
        }
    }

    public function getDateTimeDifferences(): array {
        return [
            [
                1592906400
                , 1592820000
                , 1
            ]
            , [
                1592906930
                , 1592906929
                , 0
            ]
            , [
                1592848105
                , 1592761704
                , 1
            ]
            , [
                1592848105
                , 1592761706
                , 0
            ]
        ];
    }

    public function getTimestamps(): array {
        return [
            [0]
            , [1095379198]
            , [1095379199]
            , [1095379199]
            , [1095379199]
            , [1095379199]
            , [1095379200]
            , [1095379200]
            , [1095379200]
            , [1095379200]
            , [1095379201]
            , [1095379201]
            , [-1]
        ];
    }

    public function getFormattedTimestamps(): array {
        return [
            // Y-m-d H:i:s
            ["1969-12-31 16:00:00", false]
            , ["2004-09-16 16:59:58", false]
            , ["2004-09-16 16:59:59", false]
            , ["2004-09-16 16:59:59", false]
            , ["2004-09-16 16:59:59", false]

            // d.m.Y H:i:s
            , ["16.09.2004 16:59:59", false]
            , ["16.09.2004 16:59:59", false]
            , ["16.09.2004 17:00:00", false]
            , ["16.09.2004 17:00:00", false]
            , ["16.09.2004 17:00:00", false]

        ];
    }

    protected function setUp(): void {
        parent::setUp();
        $this->dateTimeService = new DateTimeService();
    }

}
