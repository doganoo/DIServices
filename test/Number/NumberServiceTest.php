<?php
declare(strict_types=1);
/**
 * DIServices
 *
 * Copyright (C) <2021> <Dogan Ucar>
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

namespace doganoo\DI\Test\Number;

use doganoo\DI\Number\INumberService;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Number\NumberService;

class NumberServiceTest extends TestCase {

    private INumberService $numberService;

    protected function setUp(): void {
        parent::setUp();
        $this->numberService = new NumberService();
    }

    /**
     * @param float      $number
     * @param float|null $epsilon
     * @param bool       $isZero
     * @dataProvider provideIsZeroData
     */
    public function testIsZero(float $number, ?float $epsilon, bool $isZero): void {
        if (null !== $epsilon) {
            $this->assertTrue($isZero === $this->numberService->isZero($number, $epsilon));
        } else {
            $this->assertTrue($isZero === $this->numberService->isZero($number));
        }
    }

    public function provideIsZeroData(): array {
        return [
            [1, 0000.1, false]
            , [1, 0000.1, false]
            , [2, 0000.1, false]
            , [3, 0000.1, false]
            , [4, 0000.1, false]
            , [5, 0000.1, false]
            , [0.2, 0000.1, false]
            , [0.1, 0000.1, false]
            , [0.000000000003, 0000.1, true]
            , [0.00000002, 0000.1, true]
            , [0.0000034564, 0000.1, true]
            , [0.00000003424583, 0000.1, true]

            // same test without epsilon

            , [1, null, false]
            , [1, null, false]
            , [2, null, false]
            , [3, null, false]
            , [4, null, false]
            , [5, null, false]
            , [0.2, null, false]
            , [0.1, null, false]
            , [0.000000000003, null, true]
            , [0.00000002, null, true]
            , [0.0000034564, null, true]
            , [0.00000003424583, null, true]
        ];
    }

}