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


namespace doganoo\DI\Test\HTTP\URL;


use DateTimeInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\DateTime\CalendarService;
use doganoo\DIP\DateTime\DateTimeService;

class CalendarServiceTest extends TestCase {

    /** @var CalendarService */
    private $calendarService;

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
