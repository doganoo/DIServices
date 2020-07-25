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
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Exception\HTTP\UnknownStatusCodeException;
use doganoo\DIP\HTTP\HTTPService;

class HTTPServiceTest extends TestCase {

    /** @var IHTTPService */
    private $httpService;

    /**
     * @param int    $code
     * @param string $description
     *
     * @dataProvider getStatusCodes
     */
    public function testGetDescriptionByCode(int $code, string $description) {
        $result = $this->httpService->translateCode($code);
        $this->assertTrue($result === $description);
    }

    public function testException() {
        try {
            $this->httpService->translateCode(500);
        } catch (UnknownStatusCodeException $exception) {
            $this->assertTrue(true);
        }
    }

    public function getStatusCodes() {
        return [
            [200, "OK"]
            , [400, "BAD REQUEST"]
            , [404, "NOT FOUND"]
        ];
    }

    protected function setUp() {
        parent::setUp();

        $this->httpService = new HTTPService();
    }

}
