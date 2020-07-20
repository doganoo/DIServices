<?php
declare(strict_types=1);
/**
 * DiServices
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

namespace doganoo\DIP\DateTime;

use doganoo\DI\DateTime\ICalendarService;
use doganoo\DI\DateTime\IDateTimeService;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use function easter_date;

/**
 * Class CalendarService
 *
 * @package doganoo\DIP\DateTime
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class CalendarService implements ICalendarService {

    /** @var IDateTimeService */
    private $dateTimeService;

    public function __construct(IDateTimeService $dateTimeService) {
        $this->dateTimeService = $dateTimeService;
    }

    /**
     * Returns a list of (germany based) holidays
     *
     * @param int $year The year for that the holidays are computed
     *
     * @return HashTable
     */
    public function getPublicHolidays(int $year): HashTable {

        $holidays     = new HashTable();
        $numberOfDays = 60 * 60 * 24;

        $easterSunday = $this->dateTimeService->toDateTime(easter_date($year));

        // static holidays
        $holidays->put(
            ICalendarService::NEW_YEAR
            , $this->dateTimeService->fromString("$year-01-01")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::INTERNATIONAL_WORKER_DAY
            , $this->dateTimeService->fromString("$year-05-01")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::ANNIVERSARY_OF_GERMAN_UNIFICATION
            , $this->dateTimeService->fromString("$year-10-03")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::CHRISTMAS_DAY
            , $this->dateTimeService->fromString("$year-12-25")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::BOXING_DAY
            , $this->dateTimeService->fromString("$year-12-26")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::NEW_YEARS_EVE
            , $this->dateTimeService->fromString("$year-12-31")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::ALL_SAINTS_DAY
            , $this->dateTimeService->fromString("$year-11-01")->getTimestamp()
        );
        $holidays->put(
            ICalendarService::CHRISTMAS_EVE
            , $this->dateTimeService->fromString("$year-12-24")->getTimestamp()
        );

        // dynamic holidays
        $holidays->put(
            ICalendarService::GOOD_FRIDAY
            , $this->dateTimeService->fromString("$year-12-24")->getTimestamp()
        );

        $holidays->put(
            ICalendarService::GOOD_FRIDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() - 2 * $numberOfDays
        )
        );
        $holidays->put(
            ICalendarService::EASTER_MONDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 1 * $numberOfDays
        )
        );
        $holidays->put(
            ICalendarService::ASCENSION_DAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 39 * $numberOfDays
        )
        );
        $holidays->put(
            ICalendarService::WHIT_MONDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 50 * $numberOfDays
        )
        );

        $holidays->put(
            ICalendarService::CORPUS_CHRISTI
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 60 * $numberOfDays
        )
        );
        $holidays->put(
            ICalendarService::PALM_SUNDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() - 7 * $numberOfDays
        )
        );
        $holidays->put(
            ICalendarService::HOLY_SATURDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() - 1 * $numberOfDays
        )
        );
        $holidays->put(
            ICalendarService::EASTER_SUNDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() * $numberOfDays
        )
        );


        $holidays->put(
            ICalendarService::FIRST_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+1 sunday")
        );

        $holidays->put(
            ICalendarService::SECOND_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+2 sunday")
        );
        $holidays->put(
            ICalendarService::THIRD_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+3 sunday")
        );
        $holidays->put(
            ICalendarService::FOURTH_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+4 sunday")
        );

        return $holidays;
    }

}
