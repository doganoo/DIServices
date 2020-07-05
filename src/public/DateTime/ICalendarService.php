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

namespace doganoo\DI\DateTime;

/**
 * Interface ICalendarService
 *
 * @package doganoo\DI\DateTime
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
interface ICalendarService {

    public const NEW_YEAR                          = 0;
    public const INTERNATIONAL_WORKER_DAY          = 1;
    public const ANNIVERSARY_OF_GERMAN_UNIFICATION = 2;
    public const CHRISTMAS_DAY                     = 3;
    public const BOXING_DAY                        = 4;
    public const NEW_YEARS_EVE                     = 5;
    public const ALL_SAINTS_DAY                    = 6;
    public const CHRISTMAS_EVE                     = 7;
    public const GOOD_FRIDAY                       = 8;
    public const EASTER_MONDAY                     = 9;
    public const ASCENSION_DAY                     = 10;
    public const WHIT_MONDAY                       = 11;
    public const CORPUS_CHRISTI                    = 12;
    public const PALM_SUNDAY                       = 14;
    public const HOLY_SATURDAY                     = 15;
    public const EASTER_SUNDAY                     = 16;
    public const FIRST_ADVENT                      = 17;
    public const SECOND_ADVENT                     = 18;
    public const THIRD_ADVENT                      = 19;
    public const FOURTH_ADVENT                     = 20;

    /**
     * Returns a list of (germany based) holidays
     *
     * @param int $year The year for that the holidays are computed
     *
     * @return array
     */
    public function getPublicHolidays(int $year): array;

}
