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

namespace doganoo\DI\Test\DateTime;

use DateTime;
use DateTimeInterface;
use doganoo\DI\DateTime\DateTimeServiceInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\DateTime\DateTimeService;
use TypeError;

class DateTimeServiceTest extends TestCase {

    /** @var DateTimeServiceInterface */
    private $dateTimeService;

    /**
     * @param int $timestamp
     *
     * @dataProvider getTimestamps
     */
    public function testFromTimestamp(int $timestamp): void {
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
    public function testDateDifference(int $start, int $end, int $days): void {
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
    public function testFromFormat(string $format, bool $isNull): void {
        $dateTime = $this->dateTimeService->fromFormat($format);

        if (true === $isNull) {
            $this->assertNull($dateTime);
        } else {
            $this->assertTrue($dateTime instanceof DateTimeInterface);
            $this->assertTrue($dateTime->getTimestamp() === strtotime($format));
        }
    }

    /**
     * @param DateTimeInterface $dateTime
     * @param string            $formatted
     * @dataProvider getYMDHIS
     */
    public function testToYMDHIS(DateTimeInterface $dateTime, string $formatted): void {
        $string = $this->dateTimeService->toYMDHIS($dateTime);
        $this->assertTrue($string === $formatted);
    }

    /**
     * @param DateTimeInterface $dateTime
     * @param string            $formatted
     * @dataProvider getDMYHIS
     */
    public function testToDMYHIS(DateTimeInterface $dateTime, string $formatted): void {
        $string = $this->dateTimeService->toDMYHIS($dateTime);
        $this->assertTrue($string === $formatted);
    }

    /**
     * @param DateTimeInterface $dateTime
     * @param string            $formatted
     * @dataProvider getHIS
     */
    public function testToHIS(DateTimeInterface $dateTime, string $formatted): void {
        $string = $this->dateTimeService->toHIS($dateTime);
        $this->assertTrue($string === $formatted);
    }

    /**
     * @param DateTimeInterface $dateTime
     * @param string            $formatted
     * @dataProvider getYMD
     */
    public function testToYMD(DateTimeInterface $dateTime, string $formatted): void {
        $string = $this->dateTimeService->toYMD($dateTime);
        $this->assertTrue($string === $formatted);
    }

    /**
     * @return void
     */
    public function testNull(): void {
        $this->expectException(TypeError::class);
        $this->dateTimeService->toYMD(null);
    }

    public function getYMD(): array {
        return [
            [
                (new DateTime("2020-08-01"))
                , "2020-08-01"
            ]
            , [
                (new DateTime("2018-07-05"))
                , "2018-07-05"
            ]
            , [
                (new DateTime("1999-01-01"))
                , "1999-01-01"
            ]
            , [
                (new DateTime("3200-12-18"))
                , "3200-12-18"
            ]
            ,
        ];
    }

    public function getYMDHIS(): array {
        return [
            [
                (new DateTime("2020-08-01 14:25:33"))
                , "2020-08-01 14:25:33"
            ]
            , [
                (new DateTime("2018-07-05 22:09:14"))
                , "2018-07-05 22:09:14"
            ]
            , [
                (new DateTime("1999-01-01 03:02:44"))
                , "1999-01-01 03:02:44"
            ]
            , [
                (new DateTime("3200-12-18 12:00:01"))
                , "3200-12-18 12:00:01"
            ]
            ,
        ];
    }

    public function getHIS(): array {
        return [
            [
                (new DateTime("2020-08-01 14:25:33"))
                , "14:25:33"
            ]
            , [
                (new DateTime("2018-07-05 22:09:14"))
                , "22:09:14"
            ]
            , [
                (new DateTime("1999-01-01 03:02:44"))
                , "03:02:44"
            ]
            , [
                (new DateTime("3200-12-18 12:00:01"))
                , "12:00:01"
            ]
            ,
        ];
    }

    public function getDMYHIS(): array {
        return [
            [
                (new DateTime("2020-08-01 14:25:33"))
                , "01.08.2020 14:25:33"
            ]
            , [
                (new DateTime("2018-07-05 22:09:14"))
                , "05.07.2018 22:09:14"
            ]
            , [
                (new DateTime("1999-01-01 03:02:44"))
                , "01.01.1999 03:02:44"
            ]
            , [
                (new DateTime("3200-12-18 12:00:01"))
                , "18.12.3200 12:00:01"
            ]
            ,
        ];
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
            , [
                1592906400
                , 1592992800
                , 1
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
