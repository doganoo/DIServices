<?php
declare(strict_types=1);
/**
 * DiServices
 *
 * Copyright (C) <2023> <Dogan Ucar>
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

namespace doganoo\DIP\Object\Arrays;

use doganoo\DI\Object\Arrays\ArrayServiceInterface;

class ArrayService implements ArrayServiceInterface {

    public function arrayFilterRecursive(array $array, $filterVal = null): array {
        foreach ($array as $key => & $value) { // mind the reference
            if (is_array($value)) {
                $value = $this->arrayFilterRecursive($value, $filterVal);
                if ($value === $filterVal) {
                    unset($array[$key]);
                }
            } else {
                if ($value === $filterVal) {
                    unset($array[$key]);
                }
            }
        }
        unset($value); // kill the reference
        return $array;
    }

}