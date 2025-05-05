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

namespace doganoo\DIP\Http;

use doganoo\DI\HTTP\HttpServiceInterface;
use doganoo\DI\HTTP\StatusInterface;
use doganoo\DIP\Exception\Http\UnknownStatusCodeException;

/**
 * Class HTTPService
 *
 * @package doganoo\DIP\HTTP
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class HttpService implements HttpServiceInterface {

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
            case StatusInterface::CONTINUE:
                return StatusInterface::CONTINUE_TEXT;
            case StatusInterface::SWITCHING_PROTOCOLS:
                return StatusInterface::SWITCHING_PROTOCOLS_TEXT;
            case StatusInterface::PROCESSING:
                return StatusInterface::PROCESSING_TEXT;
            case StatusInterface::EARLY_HINTS:
                return StatusInterface::EARLY_HINTS_TEXT;
            case StatusInterface::OK:
                return StatusInterface::OK_TEXT;
            case StatusInterface::CREATED:
                return StatusInterface::CREATED_TEXT;
            case StatusInterface::ACCEPTED:
                return StatusInterface::ACCEPTED_TEXT;
            case StatusInterface::NON_AUTHORITATIVE_INFORMATION:
                return StatusInterface::NON_AUTHORITATIVE_INFORMATION_TEXT;
            case StatusInterface::NO_CONTENT:
                return StatusInterface::NO_CONTENT_TEXT;
            case StatusInterface::RESET_CONTENT:
                return StatusInterface::RESET_CONTENT_TEXT;
            case StatusInterface::PARTIAL_CONTENT:
                return StatusInterface::PARTIAL_CONTENT_TEXT;
            case StatusInterface::MULTI_STATUS:
                return StatusInterface::MULTI_STATUS_TEXT;
            case StatusInterface::ALREADY_REPORTED:
                return StatusInterface::ALREADY_REPORTED_TEXT;
            case StatusInterface::IM_USED:
                return StatusInterface::IM_USED_TEXT;
            case StatusInterface::BAD_REQUEST:
                return StatusInterface::BAD_REQUEST_TEXT;
            case StatusInterface::UNAUTHORIZED:
                return StatusInterface::UNAUTHORIZED_TEXT;
            case StatusInterface::FORBIDDEN:
                return StatusInterface::FORBIDDEN_TEXT;
            case StatusInterface::NOT_FOUND:
                return StatusInterface::NOT_FOUND_TEXT;
            case StatusInterface::NOT_ALLOWED:
                return StatusInterface::NOT_ALLOWED_TEXT;
            case StatusInterface::NOT_ACCEPTABLE:
                return StatusInterface::NOT_ACCEPTABLE_TEXT;
            case StatusInterface::GONE:
                return StatusInterface::GONE_TEXT;
            case StatusInterface::PAYLOAD_TOO_LARGE:
                return StatusInterface::PAYLOAD_TOO_LARGE_TEXT;
            case StatusInterface::INTERNAL_SERVER_ERROR:
                return StatusInterface::INTERNAL_SERVER_ERROR_TEXT;
            case StatusInterface::NOT_IMPLEMENTED:
                return StatusInterface::NOT_IMPLEMENTED_TEXT;
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

    /**
     * Removes the port information after the address if exists
     *
     * @param string $address
     * @return string
     */
    public function removePort(string $address): string {
        return preg_replace('/:[0-9]+/', '', $address);
    }

}
