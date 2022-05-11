<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2020 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\DI\Test\Object\String;

use doganoo\DI\Object\String\IStringService;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Object\String\StringService;

/**
 * Class StringServiceTest
 *
 * @package doganoo\DI\Test\HTTP\URL
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class StringServiceTest extends TestCase {

    /** @var IStringService */
    private $stringService;

    /**
     * @param string|null $value
     * @param bool        $valid
     *
     * @dataProvider getData
     */
    public function testIsEmpty(?string $value, bool $valid): void {
        $this->assertTrue($valid === $this->stringService->isEmpty($value));
    }

    /**
     * @param string $first
     * @param string $second
     * @param bool   $equal
     * @return void
     * @dataProvider getIsEqualCaseSensitiveData
     */
    public function testIsEqualCaseSensitive(string $first, string $second, bool $equal): void {
        $this->assertTrue(
            $equal === $this->stringService->equals($first, $second)
        );
    }

    /**
     * @param string $first
     * @param string $second
     * @param bool   $equal
     * @return void
     * @dataProvider getIsEqualCaseInsensitiveData
     */
    public function testIsEqualCaseInsensitive(string $first, string $second, bool $equal): void {
        $this->assertTrue(
            $equal === $this->stringService->equalsIgnoreCase($first, $second)
        );
    }

    public function getIsEqualCaseSensitiveData(): array {
        return [
            ['a', 'a', true],
            ['a', 'A', false],
            ['tralalalalallalalal', 'tralalalalallalalal1234', false],
            ['tralalalalallalalal', 'tralalalalallalalal', true],
            ['tralalalalallalalal', 'tralalalalallalaLal', false],
            ['dasistdashausvonnikolaus', 'thisisallgoodyouknowwhatimean', false],
        ];
    }

    public function getIsEqualCaseInsensitiveData(): array {
        return [
            ['a', 'a', true],
            ['a', 'A', true],
            ['tralalalalallalalal', 'tralalalalallalalal1234', false],
            ['tralalalalallalalal', 'tralalalalallalalal', true],
            ['tralalalalallalalal', 'tralalalalallalaLal', true],
            ['dasistdashausvonnikolaus', 'thisisallgoodyouknowwhatimean', false],
            ['kEeStAsH', 'keestash', true],
        ];

    }

    public function getData(): array {
        return [
            [
                ""
                , true
            ]
            , [
                null
                , true
            ]
            , [
                "    "
                , true
            ]
            , [
                ","
                , false
            ]
            , [
                "diservices"
                , false
            ]
        ];
    }

    protected function setUp(): void {
        $this->stringService = new StringService();
        parent::setUp();
    }

}
