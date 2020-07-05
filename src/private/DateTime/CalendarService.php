<?php
declare(strict_types=1);
/**
 * Keestash
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
use function easter_date;

/**
 * Class CalendarService
 *
 * @package doganoo\DIP\DateTime
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class CalendarService implements ICalendarService {

    /**
     * Returns a list of (germany based) holidays
     *
     * @param int $year The year for that the holidays are computed
     *
     * @return array
     */
    public function getPublicHolidays(int $year): array {

        $numberOfDays = 60 * 60 * 24;
        $easterSunday = easter_date($year);

        // static holidays
        $holidays [$year . "-01-01"] = ICalendarService::NEW_YEAR;
        $holidays [$year . "-05-01"] = ICalendarService::INTERNATIONAL_WORKER_DAY;
        $holidays [$year . "-10-03"] = ICalendarService::ANNIVERSARY_OF_GERMAN_UNIFICATION;
        $holidays [$year . "-12-25"] = ICalendarService::CHRISTMAS_DAY;
        $holidays [$year . "-12-26"] = ICalendarService::BOXING_DAY;
        $holidays [$year . "-12-31"] = ICalendarService::NEW_YEARS_EVE;
        $holidays [$year . "-11-01"] = ICalendarService::ALL_SAINTS_DAY;
        $holidays [$year . "-12-24"] = ICalendarService::CHRISTMAS_EVE;

        // dynamic holidays
        $holidays [$year . date("-m-d", $easterSunday - 2 * $numberOfDays)]  = ICalendarService::GOOD_FRIDAY;
        $holidays [$year . date("-m-d", $easterSunday + 1 * $numberOfDays)]  = ICalendarService::EASTER_MONDAY;
        $holidays [$year . date("-m-d", $easterSunday + 39 * $numberOfDays)] = ICalendarService::ASCENSION_DAY;
        $holidays [$year . date("-m-d", $easterSunday + 50 * $numberOfDays)] = ICalendarService::WHIT_MONDAY;
        $holidays [$year . date("-m-d", $easterSunday + 60 * $numberOfDays)] = ICalendarService::CORPUS_CHRISTI;
        $holidays [$year . date("-m-d", $easterSunday - 7 * $numberOfDays)]  = ICalendarService::PALM_SUNDAY;
        $holidays [$year . date("-m-d", $easterSunday - 1 * $numberOfDays)]  = ICalendarService::HOLY_SATURDAY;
        $holidays [$year . date("-m-d", $easterSunday + 0 * $numberOfDays)]  = ICalendarService::EASTER_SUNDAY;

        $holidays [$year . date("-m-d", strtotime("+1 sunday", mktime(0, 0, 0, 11, 26, $year)))] = ICalendarService::FIRST_ADVENT;
        $holidays [$year . date("-m-d", strtotime("+2 sunday", mktime(0, 0, 0, 11, 26, $year)))] = ICalendarService::SECOND_ADVENT;
        $holidays [$year . date("-m-d", strtotime("+3 sunday", mktime(0, 0, 0, 11, 26, $year)))] = ICalendarService::THIRD_ADVENT;
        $holidays [$year . date("-m-d", strtotime("+4 sunday", mktime(0, 0, 0, 11, 26, $year)))] = ICalendarService::FOURTH_ADVENT;
        return $holidays;
    }


}
