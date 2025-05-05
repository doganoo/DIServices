<?php
declare(strict_types=1);

namespace doganoo\DI\HTTP;

interface MethodInterface {

    public const GET     = "GET";
    public const HEAD    = "HEAD";
    public const POST    = "POST";
    public const PUT     = "PUT";
    public const DELETE  = "DELETE";
    public const CONNECT = "CONNECT";
    public const OPTIONS = "OPTIONS";
    public const TRACE   = "TRACE";
    public const PATCH   = "PATCH";

}