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

namespace doganoo\DI\DateTime;

use DateTime;
use DateTimeInterface;

/**
 * Interface IDateTimeService
 *
 * @package doganoo\DI\DateTime
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
interface IDateTimeService {

    /**
     * Converts an unix timestamp to an instance of DateTimeInterface
     *
     * @param int $timestamp The unix timestamp to convert
     *
     * @return DateTimeInterface
     */
    public function toDateTime(int $timestamp): DateTimeInterface;

    /**
     * Converts an string formatted date/date time pattern to an instance of DateTimeInterface
     * or null, if invalid
     *
     * @param string $format The formatted string
     *
     * @return DateTimeInterface|null
     */
    public function fromFormat(string $format): ?DateTimeInterface;

    /**
     * Returns the number of days between two date times
     *
     * @param DateTimeInterface $start The start date
     * @param DateTimeInterface $end   The end date
     *
     * @return int
     */
    public function getDifference(DateTimeInterface $start, DateTimeInterface $end): int;

    /**
     * Converts a date/datetime string to an instance of DateTimeInterface
     *
     * @param string $dateTime The dateTime as a string
     *
     * @return DateTimeInterface|null
     */
    public function fromString(string $dateTime): ?DateTimeInterface;

    /**
     * Returns the reference day for calculating 1th, 2nd, 3th and 4th advent
     *
     * @param int $year The year
     *
     * @return DateTime
     */
    public function getAdventReferenceDay(int $year): DateTime;

}
