<?php

declare(strict_types=1);

namespace ProxyRequest;

/** @template T */
final readonly class ApiResponse
{
    /**
     * @param T $data
     * @param array<string, list<string>> $headers
     */
    public function __construct(
        public mixed $data,
        public int $statusCode,
        public array $headers,
    ) {}

    /**
     * @template TValue
     * @param array{0: TValue, 1: int, 2: array<string, list<string>>} $response
     * @return self<TValue>
     */
    public static function fromHttpInfo(array $response): self
    {
        return new self($response[0], $response[1], $response[2]);
    }

    public function etag(): ?string
    {
        return $this->headerLine('ETag');
    }

    public function idempotencyReplayed(): bool
    {
        return 'true' === strtolower($this->headerLine('Idempotency-Replayed') ?? '');
    }

    private function headerLine(string $name): ?string
    {
        foreach ($this->headers as $header => $values) {
            if (0 === strcasecmp($header, $name)) {
                return implode(', ', $values);
            }
        }

        return null;
    }
}
