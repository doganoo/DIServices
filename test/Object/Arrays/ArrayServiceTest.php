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

namespace doganoo\DI\Test\Object\Arrays;

use doganoo\DI\Object\Arrays\ArrayServiceInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Object\Arrays\ArrayService;

class ArrayServiceTest extends TestCase {

    private ArrayServiceInterface $arrayService;

    protected function setUp(): void {
        parent::setUp();
        $this->arrayService = new ArrayService();
    }

    public function testRegularFilter(): void {
        $array  = [1, 2, 3, 4, null, 5];
        $result = $this->arrayService->arrayFilterRecursive($array, null);
        $this->assertTrue($result == [0 => 1, 1 => 2, 2 => 3, 3 => 4, 5 => 5]);
    }

    public function testRegularAssociativeFilter(): void {
        $array  = ["one" => 1, "two" => 2, "three" => 3, "four" => 4, "five" => null, "six" => 5];
        $result = $this->arrayService->arrayFilterRecursive($array, null);
        $this->assertTrue($result == ["one" => 1, "two" => 2, "three" => 3, "four" => 4, "six" => 5]);
    }

    public function testRecursiveFilter(): void {
        $array  = [1, 2, 3, 4, [1, null, 2], 5];
        $result = $this->arrayService->arrayFilterRecursive($array, null);
        $this->assertTrue($result == [
                0 => 1,
                1 => 2,
                2 => 3,
                3 => 4,
                4 => [
                    0 => 1,
                    2 => 2
                ],
                5 => 5]
        );
    }

    public function testRecursiveAssociativeFilter(): void {
        $array  = ["one" => 1, "two" => 2, "three" => 3, "four" => 4, "five" => ["one" => 1, "two" => null, "three" => 2], "six" => 5];
        $result = $this->arrayService->arrayFilterRecursive($array, null);
        $this->assertTrue($result == [
                "one"   => 1,
                "two"   => 2,
                "three" => 3,
                "four"  => 4,
                "five"  => [
                    "one"   => 1,
                    "three" => 2
                ],
                "six"   => 5
            ]
        );
    }

}