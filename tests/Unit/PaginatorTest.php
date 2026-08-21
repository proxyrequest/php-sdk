<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ProxyRequest\Support\Paginator;

final class PaginatorTest extends TestCase
{
    public function testItFollowsNextOffsetsLazily(): void
    {
        $offsets = [];
        $paginator = new Paginator(function (int $limit, int $offset) use (&$offsets): object {
            $offsets[] = $offset;

            return new class ($offset) {
                public function __construct(private readonly int $offset) {}

                /** @return list<int> */
                public function getResults(): array
                {
                    return [1 + $this->offset, 2 + $this->offset];
                }

                public function getNext(): ?string
                {
                    return 0 === $this->offset ? 'https://api.example/items?limit=2&offset=2' : null;
                }
            };
        }, limit: 2);

        self::assertSame([1, 2, 3, 4], iterator_to_array($paginator));
        self::assertSame([0, 2], $offsets);
    }
}
