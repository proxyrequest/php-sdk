<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use ProxyRequest\ObjectSerializer;

/** Query dates retain the server's timezone and date-format interpretation. */
final class AnalyticsDate
{
    public static function serialize(\DateTimeInterface|string|int|float|null $value): ?string
    {
        if (null === $value || \is_string($value)) {
            return $value;
        }
        if ($value instanceof \DateTimeInterface) {
            return ObjectSerializer::toString(\DateTime::createFromInterface($value));
        }
        if (\is_float($value) && !is_finite($value)) {
            throw new \InvalidArgumentException('Analytics timestamps must be finite Unix seconds.');
        }
        return (string) $value;
    }
}
