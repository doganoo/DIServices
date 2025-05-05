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

namespace doganoo\DI\Test\Http;

use doganoo\DI\HTTP\HttpServiceInterface;
use doganoo\DI\HTTP\StatusInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Exception\Http\UnknownStatusCodeException;
use doganoo\DIP\Http\HttpService;

class HttpServiceTest extends TestCase {

    private HttpServiceInterface $httpService;

    protected function setUp(): void {
        parent::setUp();
        $this->httpService = new HttpService();
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
            [StatusInterface::CONTINUE, StatusInterface::CONTINUE_TEXT]
            , [StatusInterface::SWITCHING_PROTOCOLS, StatusInterface::SWITCHING_PROTOCOLS_TEXT]
            , [StatusInterface::PROCESSING, StatusInterface::PROCESSING_TEXT]
            , [StatusInterface::EARLY_HINTS, StatusInterface::EARLY_HINTS_TEXT]
            , [StatusInterface::OK, StatusInterface::OK_TEXT]
            , [StatusInterface::CREATED, StatusInterface::CREATED_TEXT]
            , [StatusInterface::ACCEPTED, StatusInterface::ACCEPTED_TEXT]
            , [StatusInterface::NON_AUTHORITATIVE_INFORMATION, StatusInterface::NON_AUTHORITATIVE_INFORMATION_TEXT]
            , [StatusInterface::NO_CONTENT, StatusInterface::NO_CONTENT_TEXT]
            , [StatusInterface::RESET_CONTENT, StatusInterface::RESET_CONTENT_TEXT]
            , [StatusInterface::PARTIAL_CONTENT, StatusInterface::PARTIAL_CONTENT_TEXT]
            , [StatusInterface::MULTI_STATUS, StatusInterface::MULTI_STATUS_TEXT]
            , [StatusInterface::ALREADY_REPORTED, StatusInterface::ALREADY_REPORTED_TEXT]
            , [StatusInterface::IM_USED, StatusInterface::IM_USED_TEXT]
            , [StatusInterface::BAD_REQUEST, StatusInterface::BAD_REQUEST_TEXT]
            , [StatusInterface::UNAUTHORIZED, StatusInterface::UNAUTHORIZED_TEXT]
            , [StatusInterface::FORBIDDEN, StatusInterface::FORBIDDEN_TEXT]
            , [StatusInterface::NOT_FOUND, StatusInterface::NOT_FOUND_TEXT]
            , [StatusInterface::NOT_ALLOWED, StatusInterface::NOT_ALLOWED_TEXT]
            , [StatusInterface::NOT_ACCEPTABLE, StatusInterface::NOT_ACCEPTABLE_TEXT]
            , [StatusInterface::GONE, StatusInterface::GONE_TEXT]
            , [StatusInterface::PAYLOAD_TOO_LARGE, StatusInterface::PAYLOAD_TOO_LARGE_TEXT]
            , [StatusInterface::INTERNAL_SERVER_ERROR, StatusInterface::INTERNAL_SERVER_ERROR_TEXT]
            , [StatusInterface::NOT_IMPLEMENTED, StatusInterface::NOT_IMPLEMENTED_TEXT]
        ];
    }


}
