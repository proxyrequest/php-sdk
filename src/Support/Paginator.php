<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use Closure;
use InvalidArgumentException;
use IteratorAggregate;
use RuntimeException;
use Traversable;

/**
 * @template T
 * @implements IteratorAggregate<int, T>
 */
final class Paginator implements IteratorAggregate
{
    /** @param Closure(int, int): object $pageFetcher */
    public function __construct(
        private readonly Closure $pageFetcher,
        private readonly int $limit = 100,
        private readonly int $offset = 0,
        private readonly int $maxPages = 10_000,
    ) {
        if ($limit < 1 || $offset < 0 || $maxPages < 1) {
            throw new InvalidArgumentException('Paginator limit/maxPages must be positive and offset must not be negative.');
        }
    }

    /** @return Traversable<int, T> */
    public function getIterator(): Traversable
    {
        $offset = $this->offset;
        $visited = [];

        for ($pageNumber = 0; $pageNumber < $this->maxPages; ++$pageNumber) {
            $page = ($this->pageFetcher)($this->limit, $offset);

            if (!method_exists($page, 'getResults') || !method_exists($page, 'getNext')) {
                throw new RuntimeException('A page object must expose getResults() and getNext().');
            }

            $results = $page->getResults();
            if (!is_iterable($results)) {
                throw new RuntimeException('Page results must be iterable.');
            }

            $count = 0;
            foreach ($results as $result) {
                ++$count;
                /** @var T $result */
                yield $result;
            }

            $next = $page->getNext();
            if (null === $next || '' === $next) {
                return;
            }
            if (!\is_string($next) || isset($visited[$next])) {
                throw new RuntimeException('The API returned an invalid or repeated pagination URL.');
            }
            $visited[$next] = true;

            parse_str((string) parse_url($next, PHP_URL_QUERY), $nextQuery);
            $nextOffset = filter_var($nextQuery['offset'] ?? null, FILTER_VALIDATE_INT);
            $offset = false !== $nextOffset ? $nextOffset : $offset + $count;
        }

        throw new RuntimeException('Pagination stopped after the configured maximum number of pages.');
    }
}
