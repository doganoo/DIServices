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

namespace doganoo\DI\HTTP;

interface IStatus {

    public const CONTINUE            = 100;
    public const SWITCHING_PROTOCOLS = 101;
    public const PROCESSING          = 102;
    public const EARLY_HINTS         = 103;

    public const OK                            = 200;
    public const CREATED                       = 201;
    public const ACCEPTED                      = 202;
    public const NON_AUTHORITATIVE_INFORMATION = 203;
    public const NO_CONTENT                    = 204;
    public const RESET_CONTENT                 = 205;
    public const PARTIAL_CONTENT               = 206;
    public const MULTI_STATUS                  = 207;
    public const ALREADY_REPORTED              = 208;
    public const IM_USED                       = 226;

    public const BAD_REQUEST           = 400;
    public const UNAUTHORIZED          = 401;
    public const FORBIDDEN             = 403;
    public const NOT_FOUND             = 404;
    public const NOT_ALLOWED           = 405;
    public const NOT_ACCEPTABLE        = 406;
    public const GONE                  = 410;
    public const PAYLOAD_TOO_LARGE     = 413;
    public const INTERNAL_SERVER_ERROR = 500;
    public const NOT_IMPLEMENTED       = 501;

    public const CONTINUE_TEXT            = "CONTINUE";
    public const SWITCHING_PROTOCOLS_TEXT = "SWITCHING PROTOCOLS";
    public const PROCESSING_TEXT          = "PROCESSING";
    public const EARLY_HINTS_TEXT         = "EARLY HINTS";

    public const OK_TEXT                            = "OK";
    public const CREATED_TEXT                       = "CREATED";
    public const ACCEPTED_TEXT                      = "ACCEPTED";
    public const NON_AUTHORITATIVE_INFORMATION_TEXT = "NON-AUTHORITATIVE INFORMATION";
    public const NO_CONTENT_TEXT                    = "NO CONTENT";
    public const RESET_CONTENT_TEXT                 = "RESET CONTENT";
    public const PARTIAL_CONTENT_TEXT               = "PARTIAL CONTENT";
    public const MULTI_STATUS_TEXT                  = "MULTI-STATUS";
    public const ALREADY_REPORTED_TEXT              = "ALREADY REPORTED";
    public const IM_USED_TEXT                       = "IM USED";

    public const BAD_REQUEST_TEXT           = "BAD REQUEST";
    public const UNAUTHORIZED_TEXT          = "UNAUTHORIZED";
    public const FORBIDDEN_TEXT             = "FORBIDDEN";
    public const NOT_FOUND_TEXT             = "NOT FOUND";
    public const NOT_ALLOWED_TEXT           = "NOT ALLOWED";
    public const NOT_ACCEPTABLE_TEXT        = "NOT ACCEPTABLE";
    public const GONE_TEXT                  = "GONE";
    public const PAYLOAD_TOO_LARGE_TEXT     = "PAYLOAD TOO LARGE";
    public const INTERNAL_SERVER_ERROR_TEXT = "INTERNAL SERVER ERROR";
    public const NOT_IMPLEMENTED_TEXT       = "NOT IMPLEMENTED";

    public const RESPONSE_CODE_OK              = 1000;
    public const RESPONSE_CODE_NOT_OK          = 2000;
    public const RESPONSE_CODE_SESSION_EXPIRED = 3000;
    public const RESPONSE_CODE_NEEDS_UPGRADE   = 4000;

    public const HEADER_CONTENT_TYPE = "Content-Type";


}