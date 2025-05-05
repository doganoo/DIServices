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

namespace doganoo\DIP\Object\Float;

use doganoo\DI\Object\Float\FloatServiceInterface;

class FloatService implements FloatServiceInterface {

    /**
     * Compares two floats
     *
     * Because you should never compare floats directly with <, > or ===
     *
     * http://php.net/manual/de/language.types.float.php
     *
     * @param float $first
     * @param float $second
     *
     * @return bool
     */
    public function equals(float $first, float $second): bool {
        $epsilon = 0.00001;
        if (abs($first - $second) < $epsilon) {
            return true;
        }
        return false;
    }

    /**
     * Checks whether a value is in a given range. If $lgte is set, the method will check
     * for greater/lower than
     *
     * @param float $value The actual value
     * @param float $lower The lowest value
     * @param float $upper The highest value
     * @param bool  $lgte  greater/lower than
     *
     * @return bool
     */
    public function isBetween(float $value, float $lower, float $upper, bool $lgte = false): bool {
        $greater = $this->greaterThan($value, $lower, $lgte);
        $less    = $this->lessThan($value, $upper, $lgte);
        return true === $greater && true === $less;
    }

    /**
     * This method checks if $value is greater than $value1. If $gte is set to
     * true, the method checks if $value is greater than or equal to $value1.
     * From http://php.net/manual/de/language.types.float.php:
     * So never trust floating number results to the last digit, and do not
     * compare floating point numbers directly for equality.
     * Contributed notes in http://php.net/manual/de/language.types.float.php
     * suggests rounding the values before comparing (see 115 catalin dot luntraru at gmail dot com).
     *
     * @param float $value
     * @param float $value1
     * @param bool  $gte
     *
     * @return bool
     */
    public function greaterThan(float $value, float $value1, bool $gte = false): bool {
        $value  = round($value, 10, PHP_ROUND_HALF_EVEN);
        $value1 = round($value1, 10, PHP_ROUND_HALF_EVEN);

        if (true === $gte) {
            return $value >= $value1;
        }

        return $value > $value1;
    }

    /**
     * This method checks if $value is less than $value1. If $lte is set to
     * true, the method checks if $value is less than or equal to $value1.
     * From http://php.net/manual/de/language.types.float.php:
     * So never trust floating number results to the last digit, and do not
     * compare floating point numbers directly for equality.
     * Contributed notes in http://php.net/manual/de/language.types.float.php
     * suggests rounding the values before comparing (see 115 catalin dot luntraru at gmail dot com).
     *
     * @param float $value
     * @param float $value1
     * @param bool  $lte
     *
     * @return bool
     */
    public function lessThan(float $value, float $value1, bool $lte = false): bool {
        $value  = round($value, 10, PHP_ROUND_HALF_EVEN);
        $value1 = round($value1, 10, PHP_ROUND_HALF_EVEN);

        if (true === $lte) {
            return $value <= $value1;
        }

        return $value < $value1;
    }

}
