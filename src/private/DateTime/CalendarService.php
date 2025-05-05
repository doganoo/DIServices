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

use DateTimeInterface;
use doganoo\DI\DateTime\CalendarServiceInterface;
use doganoo\DI\DateTime\DateTimeServiceInterface;
use doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException;
use doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use function easter_date;

/**
 * Class CalendarService
 *
 * @package doganoo\DIP\DateTime
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class CalendarService implements CalendarServiceInterface {

    private DateTimeServiceInterface $dateTimeService;

    public function __construct(DateTimeServiceInterface $dateTimeService) {
        $this->dateTimeService = $dateTimeService;
    }

    /**
     * Returns a list of (germany based) holidays
     *
     * @param int $year The year for that the holidays are computed
     *
     * @return HashTable
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function getPublicHolidays(int $year): HashTable {

        $holidays     = new HashTable();
        $numberOfDays = 60 * 60 * 24;

        $easterSunday = $this->dateTimeService->toDateTime(easter_date($year));

        // static holidays
        $holidays->put(
            CalendarServiceInterface::NEW_YEAR
            , $this->dateTimeService->fromString("$year-01-01")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::INTERNATIONAL_WORKER_DAY
            , $this->dateTimeService->fromString("$year-05-01")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::ANNIVERSARY_OF_GERMAN_UNIFICATION
            , $this->dateTimeService->fromString("$year-10-03")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::CHRISTMAS_DAY
            , $this->dateTimeService->fromString("$year-12-25")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::BOXING_DAY
            , $this->dateTimeService->fromString("$year-12-26")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::NEW_YEARS_EVE
            , $this->dateTimeService->fromString("$year-12-31")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::ALL_SAINTS_DAY
            , $this->dateTimeService->fromString("$year-11-01")->getTimestamp()
        );
        $holidays->put(
            CalendarServiceInterface::CHRISTMAS_EVE
            , $this->dateTimeService->fromString("$year-12-24")->getTimestamp()
        );

        // dynamic holidays
        $holidays->put(
            CalendarServiceInterface::GOOD_FRIDAY
            , $this->dateTimeService->fromString("$year-12-24")->getTimestamp()
        );

        $holidays->put(
            CalendarServiceInterface::GOOD_FRIDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() - 2 * $numberOfDays
        )
        );
        $holidays->put(
            CalendarServiceInterface::EASTER_MONDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 1 * $numberOfDays
        )
        );
        $holidays->put(
            CalendarServiceInterface::ASCENSION_DAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 39 * $numberOfDays
        )
        );
        $holidays->put(
            CalendarServiceInterface::WHIT_MONDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 50 * $numberOfDays
        )
        );

        $holidays->put(
            CalendarServiceInterface::CORPUS_CHRISTI
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() + 60 * $numberOfDays
        )
        );
        $holidays->put(
            CalendarServiceInterface::PALM_SUNDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() - 7 * $numberOfDays
        )
        );
        $holidays->put(
            CalendarServiceInterface::HOLY_SATURDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() - 1 * $numberOfDays
        )
        );
        $holidays->put(
            CalendarServiceInterface::EASTER_SUNDAY
            , $this->dateTimeService->toDateTime(
            $easterSunday->getTimestamp() * $numberOfDays
        )
        );


        $holidays->put(
            CalendarServiceInterface::FIRST_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+1 sunday")
        );

        $holidays->put(
            CalendarServiceInterface::SECOND_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+2 sunday")
        );
        $holidays->put(
            CalendarServiceInterface::THIRD_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+3 sunday")
        );
        $holidays->put(
            CalendarServiceInterface::FOURTH_ADVENT
            , $this->dateTimeService->getAdventReferenceDay($year)->modify("+4 sunday")
        );

        return $holidays;
    }

    public function hasOverlap(DateTimeInterface $s1, DateTimeInterface $e1, DateTimeInterface $s2, DateTimeInterface $e2): bool {
        return $s1 < $e2 && $s2 <= $e1;
    }

}
