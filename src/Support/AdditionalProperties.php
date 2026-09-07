<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

/** Retain unrecognised wire fields without dynamic PHP properties. */
abstract class AdditionalProperties
{
    /** @var array<string, mixed> */
    private array $additionalProperties = [];

    /** @return array<string, mixed> */
    public function getAdditionalProperties(): array
    {
        return $this->additionalProperties;
    }

    /** @param array<string, mixed> $properties */
    public function setAdditionalProperties(array $properties): void
    {
        $this->additionalProperties = $properties;
    }
}
