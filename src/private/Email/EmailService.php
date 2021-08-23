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

namespace doganoo\DIP\Email;

use doganoo\DI\Email\IEmailService;

/**
 * Class EmailService
 *
 * @package doganoo\DIP\Email
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class EmailService implements IEmailService {

    /**
     * Extracts email addresses from a text
     *
     * @param string $plainText The plain text
     *
     * @return array
     */
    public function extractEmailAddresses(string $plainText): array {
        $emails = [];
        foreach (preg_split('/\s/', $plainText) as $token) {
            $email = filter_var(
                filter_var(
                    $token
                    , FILTER_SANITIZE_EMAIL
                )
                , FILTER_VALIDATE_EMAIL
            );

            if ($email !== false) {
                $emails [] = $email;
            }
        }
        return $emails;

    }

    /**
     * Checks whether a given string is a valid email address
     *
     * @param string $string
     * @return bool
     */
    public function isEmailAddress(string $string): bool {
        return false !== filter_var($string, FILTER_VALIDATE_EMAIL);
    }

}
