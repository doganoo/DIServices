<?php
declare(strict_types=1);

namespace doganoo\DI\Test\Object\Float;

use doganoo\DI\Object\Float\IFloatService;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Object\Float\FloatService;

/**
 * di-services
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
class FloatServiceTest extends TestCase {

    /** @var IFloatService */
    private $floatService;

    /**
     * @param float $first
     * @param float $second
     * @param bool  $result
     *
     * @dataProvider getFloats
     */
    public function testLessThan(float $first, float $second, bool $result) {
        $methodResult = $this->floatService->equals($first, $second);

        $this->assertTrue($result === $methodResult);
    }

    public function getFloats() {
        return [
            [1.23456789, 1.23456780, true]
            , [1.23456780, 1.23456789, true]

            , [1.7, 1.2, false]
            , [1.2, 1.7, false]

            , [1.111, 1.111, true]
            , [1.123456781233556, 1.123456781111111, true]
            , [1.123456781233556, 1.1234111111111, false]
        ];
    }

    protected function setUp() {
        parent::setUp();

        $this->floatService = new FloatService();
    }

}
