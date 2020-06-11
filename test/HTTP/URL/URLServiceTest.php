<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
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

namespace doganoo\DI\Test\HTTP\URL;

use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\HTTP\URL\URLService;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;

class URLServiceTest extends TestCase {

    /** @var URLService */
    private $urlService;

    /**
     * @param string $url
     * @param array  $data
     *
     * @dataProvider getData
     */
    public function testGetParameterFromUrl(string $url, array $data): void {
        $table = $this->urlService->getParameterFromUrl($url);
        $array = $table->toArray();

        // in order to avoid 'test did not perform any assertions' for empty data provider
        $this->assertInstanceOf(HashTable::class, $table);

        foreach ($data as $key => $value) {
            $this->assertArrayHasKey($key, $array);
            $this->assertEquals($value, $array[$key]);
        }

    }

    public function getData(): array {
        return [
            "playStoreUrl"  => [
                "https://play.google.com/store/apps/details?id=com.meisterlabs.mindmeister&hl=de"
                , [
                    "id"   => "com.meisterlabs.mindmeister"
                    , "hl" => "de"
                ]
            ]
            , "emptyUrl"    => [
                "https://dogan-ucar.de"
                , []
            ]
            , "emptyString" => [
                ""
                , []
            ]
            , "noHost"      => [
                "store/apps/details?id=com.meisterlabs.mindmeister&hl=de"
                , [
                    "id"   => "com.meisterlabs.mindmeister"
                    , "hl" => "de"
                ]
            ]
            , "noHost1"      => [
                "?id=com.meisterlabs.mindmeister&hl=de"
                , [
                    "id"   => "com.meisterlabs.mindmeister"
                    , "hl" => "de"
                ]
            ]
        ];
    }

    protected function setUp() {
        parent::setUp();
        $this->urlService = new URLService();
    }

}
