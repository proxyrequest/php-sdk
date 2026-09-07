<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/** @phpstan-type RetryOptions array{http_errors?: bool, delay?: int|float} */
final class IdempotencyClient implements ClientInterface
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly string $basePath,
        private readonly bool $enabled,
        private readonly string $language = 'en',
    ) {}

    /** @param RetryOptions $options */
    public function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        [$request, $protected] = $this->prepare($request);

        for ($attempt = 0; $attempt < 3; ++$attempt) {
            try {
                $response = $this->client->send($request, $options);
                $delay = $protected ? $this->responseDelay($response, $attempt) : null;
                if (null === $delay) {
                    return $response;
                }
            } catch (TransferException $exception) {
                $delay = $protected ? $this->exceptionDelay($exception, $attempt) : null;
                if (null === $delay) {
                    throw $exception;
                }
            }

            $this->rewind($request);
            usleep($delay * 1000);
        }

        throw new \LogicException('The idempotency retry loop terminated unexpectedly.');
    }

    /** @param RetryOptions $options */
    public function sendAsync(RequestInterface $request, array $options = []): PromiseInterface
    {
        [$request, $protected] = $this->prepare($request);

        return $this->sendAsyncAttempt($request, $options, $protected, 0);
    }

    /** @param RetryOptions $options */
    public function request($method, $uri, array $options = []): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }

    /** @param RetryOptions $options */
    public function requestAsync($method, $uri, array $options = []): PromiseInterface
    {
        return $this->client->requestAsync($method, $uri, $options);
    }

    public function getConfig(?string $option = null): mixed
    {
        if (!method_exists($this->client, 'getConfig')) {
            return null;
        }

        return $this->client->getConfig($option);
    }

    /** @return array{RequestInterface, bool} */
    private function prepare(RequestInterface $request): array
    {
        if (!$request->hasHeader('Accept-Language')) {
            $request = $request->withHeader('Accept-Language', $this->language);
        }
        $supported = IdempotencyPolicy::supports($request, $this->basePath);
        if (!$supported) {
            return [$request, false];
        }
        if (!$request->hasHeader('Idempotency-Key') && $this->enabled) {
            $request = $request->withHeader('Idempotency-Key', self::uuid());
        }

        return [$request, $request->hasHeader('Idempotency-Key')];
    }

    /** Prepare once before decoding so failures retain the actual request key. */
    public function prepareRequest(RequestInterface $request): RequestInterface
    {
        return $this->prepare($request)[0];
    }

    /** @param RetryOptions $options */
    private function sendAsyncAttempt(
        RequestInterface $request,
        array $options,
        bool $protected,
        int $attempt,
    ): PromiseInterface {
        $promise = $this->client->sendAsync($request, $options);

        return $promise->then(
            function (ResponseInterface $response) use ($request, $options, $protected, $attempt): ResponseInterface|PromiseInterface {
                $delay = $protected ? $this->responseDelay($response, $attempt) : null;
                if (null === $delay) {
                    return $response;
                }

                return $this->retryAsync($request, $options, $protected, $attempt, $delay);
            },
            function (mixed $reason) use ($request, $options, $protected, $attempt): PromiseInterface {
                $delay = $reason instanceof TransferException && $protected
                    ? $this->exceptionDelay($reason, $attempt)
                    : null;
                if (null === $delay) {
                    throw $reason instanceof \Throwable ? $reason : new \RuntimeException('The HTTP request was rejected.');
                }

                return $this->retryAsync($request, $options, $protected, $attempt, $delay);
            },
        );
    }

    /** @param RetryOptions $options */
    private function retryAsync(
        RequestInterface $request,
        array $options,
        bool $protected,
        int $attempt,
        int $delay,
    ): PromiseInterface {
        $this->rewind($request);
        $options['delay'] = $delay;

        return $this->sendAsyncAttempt($request, $options, $protected, $attempt + 1);
    }

    private function responseDelay(ResponseInterface $response, int $attempt): ?int
    {
        if ($attempt >= 2 || 409 !== $response->getStatusCode()) {
            return null;
        }

        return self::retryAfterMilliseconds($response);
    }

    private function exceptionDelay(TransferException $exception, int $attempt): ?int
    {
        if ($attempt >= 2) {
            return null;
        }
        $getResponse = [$exception, 'getResponse'];
        if (\is_callable($getResponse)) {
            $response = $getResponse();
            if ($response instanceof ResponseInterface) {
                return $this->responseDelay($response, $attempt);
            }
        }

        return 0 === $attempt ? 100 : 200;
    }

    private static function retryAfterMilliseconds(ResponseInterface $response): ?int
    {
        $value = $response->getHeaderLine('Retry-After');
        if ('' === $value || !is_numeric($value)) {
            return null;
        }
        $seconds = (float) $value;
        if ($seconds < 0 || $seconds > 5) {
            return null;
        }

        return (int) round($seconds * 1000);
    }

    private function rewind(RequestInterface $request): void
    {
        $body = $request->getBody();
        if (!$body->isSeekable()) {
            throw new \RuntimeException('Cannot retry an idempotent request with a non-seekable body.');
        }
        $body->rewind();
    }

    private static function uuid(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = \chr((\ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = \chr((\ord($bytes[8]) & 0x3f) | 0x80);
        $hex = bin2hex($bytes);

        return \sprintf('%s-%s-%s-%s-%s', substr($hex, 0, 8), substr($hex, 8, 4), substr($hex, 12, 4), substr($hex, 16, 4), substr($hex, 20));
    }
}
