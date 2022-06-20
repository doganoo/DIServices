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

namespace doganoo\DI\Test\HTTP;

use doganoo\DI\HTTP\IHTTPService;
use doganoo\DI\HTTP\IStatus;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Exception\HTTP\UnknownStatusCodeException;
use doganoo\DIP\HTTP\HTTPService;

class HTTPServiceTest extends TestCase {

    private IHTTPService $httpService;

    protected function setUp(): void {
        parent::setUp();
        $this->httpService = new HTTPService();
    }

    /**
     * @param int    $code
     * @param string $description
     *
     * @dataProvider getStatusCodes
     */
    public function testGetDescriptionByCode(int $code, string $description): void {
        $result = $this->httpService->translateCode($code);
        $this->assertTrue($result === $description);
    }

    public function testException(): void {
        try {
            $this->httpService->translateCode(999);
        } catch (UnknownStatusCodeException $exception) {
            $this->assertTrue(true);
        }
    }

    /**
     * @param string $actual
     * @param string $expected
     *
     * @dataProvider getTags
     */
    public function testRemoveTags(string $actual, string $expected): void {
        $this->assertTrue(
            $expected === $this->httpService->removeTags($actual)
        );
    }

    /**
     * @param string $address
     * @param string $expected
     * @return void
     *
     * @dataProvider getAddresses
     */
    public function testRemovePort(string $address, string $expected): void {
        $this->assertTrue(
            $expected === $this->httpService->removePort($address)
        );
    }

    public function getAddresses(): array {
        return [
            ['127.0.0.1:8080', '127.0.0.1']
            , ['ucar-solutions.de:1234', 'ucar-solutions.de']
            , ['https://facebook.com:9876', 'https://facebook.com']
            , ['https://google.com/sub/file/index.php:9876', 'https://google.com/sub/file/index.php']
            , ['https://subdomain.amazon.com:33', 'https://subdomain.amazon.com']
            , ['example.org', 'example.org']
            , ['https://example.org', 'https://example.org']
            , ['https://www.example.org', 'https://www.example.org']
        ];
    }

    public function getTags(): array {
        return [
            ["<br>this is a test</br>", "this is a test"]
            , ["this is the next test", "this is the next test"]
            , ["<script>alert('hello world');</script>", "alert('hello world');"]
            , ["<note><to>Tove</to><from>Jani</from><heading>Reminder</heading><body>Don't forget me this weekend!</body></note>", "ToveJaniReminderDon't forget me this weekend!"]
        ];
    }

    public function getStatusCodes(): array {
        return [
            [IStatus::OK, IStatus::OK_TEXT]
            , [IStatus::BAD_REQUEST, IStatus::BAD_REQUEST_TEXT]
            , [IStatus::UNAUTHORIZED, IStatus::UNAUTHORIZED_TEXT]
            , [IStatus::FORBIDDEN, IStatus::FORBIDDEN_TEXT]
            , [IStatus::NOT_FOUND, IStatus::NOT_FOUND_TEXT]
            , [IStatus::NOT_ALLOWED, IStatus::NOT_ALLOWED_TEXT]
            , [IStatus::NOT_ACCEPTABLE, IStatus::NOT_ACCEPTABLE_TEXT]
            , [IStatus::GONE, IStatus::GONE_TEXT]
            , [IStatus::INTERNAL_SERVER_ERROR, IStatus::INTERNAL_SERVER_ERROR_TEXT]
        ];
    }


}
