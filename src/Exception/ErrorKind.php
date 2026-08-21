<?php

declare(strict_types=1);

namespace ProxyRequest\Exception;

enum ErrorKind: string
{
    case Validation = 'validation';
    case Authentication = 'authentication';
    case Permission = 'permission';
    case NotFound = 'not_found';
    case Conflict = 'conflict';
    case RateLimit = 'rate_limit';
    case Server = 'server';
    case Network = 'network';
    case Unexpected = 'unexpected';
}
