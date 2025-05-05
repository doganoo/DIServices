<?php
declare(strict_types=1);

namespace doganoo\DI\Test\Object\Float;

use doganoo\DI\Object\Float\FloatServiceInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Object\Float\FloatService;

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
class FloatServiceTest extends TestCase {

    private FloatServiceInterface $floatService;

    protected function setUp(): void {
        parent::setUp();
        $this->floatService = new FloatService();
    }

    /**
     * @param float $first
     * @param float $second
     * @param bool  $result
     *
     * @dataProvider getFloatsForEquals
     */
    public function testEquals(float $first, float $second, bool $result) {
        $methodResult = $this->floatService->equals($first, $second);
        $this->assertTrue($result === $methodResult);
    }

    /**
     * @param float $first
     * @param float $second
     * @param bool  $lte
     * @param bool  $result
     *
     * @dataProvider getFloatsForLessThanEqual
     */
    public function testLessThanEquals(float $first, float $second, bool $lte, bool $result) {
        $methodResult = $this->floatService->lessThan($first, $second, $lte);
        $this->assertTrue($result === $methodResult);
    }

    /**
     * @param float $value
     * @param float $lower
     * @param float $upper
     * @param bool  $lgte
     * @param bool  $result
     *
     * @dataProvider getFloatsForIsBetween
     */
    public function testIsBetween(float $value, float $lower, float $upper, bool $lgte, bool $result) {
        $methodResult = $this->floatService->isBetween($value, $lower, $upper, $lgte);
        $this->assertTrue($methodResult === $result);
    }

    /**
     * @param float $first
     * @param float $second
     * @param bool  $gte
     * @param bool  $result
     *
     * @dataProvider getFloatsForGreaterThanEqual
     */
    public function testGreaterThanEquals(float $first, float $second, bool $gte, bool $result) {
        $methodResult = $this->floatService->greaterThan($first, $second, $gte);
        $this->assertTrue($result === $methodResult);
    }

    public function getFloatsForEquals() {
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

    public function getFloatsForLessThanEqual() {
        return [
            [1.2345, 1.234, true, false]
            , [1.234, 1.2345, true, true]
            , [1.234, 1.234, true, true]
            , [1.234, 1.234, false, false]
        ];
    }

    public function getFloatsForGreaterThanEqual() {
        return [
            [1.2345, 1.234, true, true]
            , [1.234, 1.2345, true, false]
            , [1.234, 1.234, true, true]
            , [1.234, 1.234, false, false]
        ];
    }

    public function getFloatsForIsBetween() {
        return [
            [1.0, 0.5, 2.7, true, true]
            , [0.5, 0.5, 2.7, true, true]
            , [0.5, 0.5, 2.7, false, false]
            , [2.7, 0.5, 2.7, true, true]
            , [2.7, 0.5, 2.7, false, false]
            , [15.7, 0.5, 2.7, false, false]
        ];
    }

}
