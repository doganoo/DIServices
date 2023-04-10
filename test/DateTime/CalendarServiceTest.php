<?php
declare(strict_types=1);
/**
 *
 * Copyright (C) <2020> <Dogan Ucar>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace doganoo\DI\Test\DateTime;

use DateTimeImmutable;
use DateTimeInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\DateTime\CalendarService;
use doganoo\DIP\DateTime\DateTimeService;

class CalendarServiceTest extends TestCase {

    private CalendarService $calendarService;

    /**
     * @param int   $year
     * @param array $timestamps
     *
     * @dataProvider getGermanPublicHolidays
     */
    public function testGermanPublicHolidays(int $year, array $timestamps) {
        $this->markTestSkipped("implement data provider");
        $holidays = $this->calendarService->getPublicHolidays($year);

        foreach ($holidays->keySet() as $holidayKey) {
            /** @var DateTimeInterface $dateTime */
            $dateTime = $holidays->get($holidayKey);

            $toCompare = $timestamps[$holidayKey] ?? null;
            $this->assertTrue($dateTime === $toCompare);
        }
    }

    /**
     * @param DateTimeInterface $s1
     * @param DateTimeInterface $s2
     * @param DateTimeInterface $e1
     * @param DateTimeInterface $e2
     * @param bool              $result
     * @return void
     * @dataProvider hasOverlap
     */
    public function testHasOverlap(
        DateTimeInterface $s1,
        DateTimeInterface $e1,
        DateTimeInterface $s2,
        DateTimeInterface $e2,
        bool              $result
    ): void {
        $this->assertTrue(
            $result === $this->calendarService->hasOverlap($s1, $e1, $s2, $e2)
        );
    }

    public function hasOverlap(): array {
        return [
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-03-30'), // e1
                new DateTimeImmutable('2023-03-15'), // s2
                new DateTimeImmutable('2023-04-15'), // e2
                true                                         // result
            ],
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-03-30'), // e1
                new DateTimeImmutable('2023-02-01'), // s2
                new DateTimeImmutable('2023-03-15'), // e2
                true                                         // result
            ],
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-03-30'), // e1
                new DateTimeImmutable('2023-03-02'), // s2
                new DateTimeImmutable('2023-03-10'), // e2
                true                                         // result
            ],
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-03-30'), // e1
                new DateTimeImmutable('2023-01-01'), // s2
                new DateTimeImmutable('2023-01-18'), // e2
                false                                         // result
            ],
            [
                new DateTimeImmutable('2023-01-01'), // s1
                new DateTimeImmutable('2023-01-30'), // e1
                new DateTimeImmutable('2023-03-01'), // s2
                new DateTimeImmutable('2023-03-22'), // e2
                false                                         // result
            ],
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-01-15'), // e1
                new DateTimeImmutable('2023-01-01'), // s2
                new DateTimeImmutable('2023-06-01'), // e2
                true                                         // result
            ],
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-03-15'), // e1
                new DateTimeImmutable('2023-01-01'), // s2
                new DateTimeImmutable('2023-03-01'), // e2
                false                                         // result
            ],
            [
                new DateTimeImmutable('2023-03-01'), // s1
                new DateTimeImmutable('2023-03-15'), // e1
                new DateTimeImmutable('2023-03-15'), // s2
                new DateTimeImmutable('2023-04-01'), // e2
                true                                         // result
            ],
        ];
    }

    public function getGermanPublicHolidays(): array {
        return [
            [
                2020
                , [

                ]
            ]
        ];
    }

    protected function setUp(): void {
        parent::setUp();
        $this->calendarService = new CalendarService(
            new DateTimeService()
        );
    }

}
