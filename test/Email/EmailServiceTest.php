<?php
declare(strict_types=1);
/**
 * DiServices
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

namespace doganoo\DI\Test\Email;

use doganoo\DI\Email\EmailServiceInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Email\EmailService;

class EmailServiceTest extends TestCase {

    private EmailServiceInterface $emailService;

    protected function setUp(): void {
        parent::setUp();
        $this->emailService = new EmailService();
    }

    /**
     * @param string $address
     * @param bool   $valid
     * @dataProvider getEmailAddresses
     */
    public function testIsEmailAddress(string $address, bool $valid): void {
        $this->assertTrue(
            $valid === $this->emailService->isEmailAddress($address)
        );
    }

    public function getEmailAddresses(): array {
        return [
            ['info@test.de', true]
            , ['info@test', false]
        ];
    }

}