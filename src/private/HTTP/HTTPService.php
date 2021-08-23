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

namespace doganoo\DIP\HTTP;

use doganoo\DI\HTTP\IHTTPService;
use doganoo\DIP\Exception\HTTP\UnknownStatusCodeException;

/**
 * Class HTTPService
 *
 * @package doganoo\DIP\HTTP
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class HTTPService implements IHTTPService {

    /**
     * @param int $statusCode
     *
     * TODO extend
     *
     * @return string
     * @throws UnknownStatusCodeException
     */
    public function translateCode(int $statusCode): string {
        switch ($statusCode) {
            case IStatus::OK:
                return IStatus::OK_TEXT;
            case IStatus::BAD_REQUEST:
                return IStatus::BAD_REQUEST_TEXT;
            case IStatus::NOT_FOUND:
                return IStatus::NOT_FOUND_TEXT;
            default:
                throw new UnknownStatusCodeException();
        }
    }

    /**
     * Removes all tags (HTML, XML, etc) of a given string $text
     *
     * @param string $text
     * @return string
     */
    public function removeTags(string $text): string {
        return strip_tags($text);
    }

}
