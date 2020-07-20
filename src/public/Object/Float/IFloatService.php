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

namespace doganoo\DI\Object\Float;

/**
 * Interface FloatService
 *
 * @package doganoo\DI\Object\Float
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
interface IFloatService {

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
    public function equals(float $first, float $second): bool ;

}
