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

namespace doganoo\DI\Test\Http\Url;

use doganoo\DI\HTTP\URL\UrlServiceInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Http\Url\UrlService;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;

class UrlServiceTest extends TestCase {

    private URLServiceInterface $urlService;

    /**
     * @param string $url
     * @param array  $data
     *
     * @dataProvider getData
     */
    public function testGetParameterFromUrl(string $url, array $data): void {
        $table  = $this->urlService->getParameterFromUrl($url);
        $keySet = $table->keySet();
        // in order to avoid 'test did not perform any assertions' for empty data provider
        $this->assertInstanceOf(HashTable::class, $table);

        foreach ($keySet as $key) {
            $value = $table->get($key);
            $this->assertNotNull($value);
        }

    }

    /**
     * @param string $raw
     * @param bool   $result
     * @return void
     * @dataProvider getIsUrlData
     */
    public function testIsUrl(string $raw, bool $result): void {
        $this->assertTrue($result === $this->urlService->isUrl($raw));
    }

    public function getIsUrlData(): array {
        return [
            ['https://ucar-solutions.de/', true]
            , ['https://stackoverflow.com/a/2058596', true]
            , ['foo@bar', false]
            , ['fooBar', false]
        ];
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
            , "noHost1"     => [
                "?id=com.meisterlabs.mindmeister&hl=de"
                , [
                    "id"   => "com.meisterlabs.mindmeister"
                    , "hl" => "de"
                ]
            ]
        ];
    }

    protected function setUp(): void {
        parent::setUp();
        $this->urlService = new URLService();
    }

}
