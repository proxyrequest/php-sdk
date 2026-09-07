<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use ProxyRequest\ApiException;
use ProxyRequest\Dto\OTPChallenge;
use ProxyRequest\Dto\TokenPairResponse;
use ProxyRequest\ObjectSerializer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Shared by every generated sync and async operation.
 * @phpstan-type GeneratedOptions array{http_errors?: bool, debug?: bool|resource}
 */
final class ResponseHandler
{
    /**
     * @param GeneratedOptions $options
     * @param array<int, string> $types
     * @return array{mixed, int, array<array<string>>}
     */
    public static function send(ClientInterface $client, RequestInterface $request, array $options, array $types): array
    {
        $request = $client instanceof IdempotencyClient ? $client->prepareRequest($request) : $request;
        try {
            $response = $client->send($request, $options);
        } catch (GuzzleException $error) {
            throw self::transportError($error, $request);
        }
        return self::decode($request, $response, $types);
    }

    /**
     * @param GeneratedOptions $options
     * @param array<int, string> $types
     */
    public static function sendAsync(ClientInterface $client, RequestInterface $request, array $options, array $types): PromiseInterface
    {
        $request = $client instanceof IdempotencyClient ? $client->prepareRequest($request) : $request;
        try {
            $promise = $client->sendAsync($request, $options);
        } catch (GuzzleException $error) {
            return Create::rejectionFor(self::transportError($error, $request));
        }
        return $promise->then(
            static fn(ResponseInterface $response): array => self::decode($request, $response, $types),
            static function (mixed $reason) use ($request): never {
                $error = $reason instanceof \Throwable ? $reason : new \RuntimeException('The HTTP request was rejected.');
                throw self::transportError($error, $request);
            },
        );
    }

    /**
     * @param array<int, string> $types
     * @return array{mixed, int, array<array<string>>}
     */
    private static function decode(RequestInterface $request, ResponseInterface $response, array $types): array
    {
        $status = $response->getStatusCode();
        $headers = $response->getHeaders();
        $key = $request->getHeaderLine('Idempotency-Key');
        $key = '' === $key ? null : $key;
        if ($status < 200 || $status >= 300) {
            throw new ApiException("ProxyRequest returned HTTP {$status}.", $status, $headers, (string) $response->getBody(), $key);
        }
        $type = $types[$status] ?? null;
        $raw = (string) $response->getBody();
        try {
            if (null === $type) {
                throw new \UnexpectedValueException('Undocumented successful response status.');
            }
            if ('void' === $type) {
                $data = null;
            } else {
                $content = '\\SplFileObject' === $type ? \GuzzleHttp\Psr7\Utils::streamFor($raw) : ('string' === $type ? $raw : json_decode($raw, false, 512, JSON_THROW_ON_ERROR));
                $serializedHeaders = array_map(static fn(array $values): string => implode(', ', $values), $headers);
                $data = ObjectSerializer::deserialize($content, $type, $serializedHeaders);
                if (($data instanceof TokenPairResponse || $data instanceof OTPChallenge) && !$data->valid()) {
                    throw new \UnexpectedValueException('Incomplete authentication response.');
                }
            }
            return [$data, $status, $headers];
        } catch (\Throwable $error) {
            throw new ApiException("Unable to decode the ProxyRequest HTTP {$status} response.", $status, $headers, $raw, $key, $error);
        }
    }

    private static function transportError(\Throwable $error, RequestInterface $request): ApiException
    {
        // Guzzle 7 and 8 attach responses to different exception subclasses.
        $getResponse = [$error, 'getResponse'];
        $candidate = \is_callable($getResponse) ? $getResponse() : null;
        $response = $candidate instanceof ResponseInterface ? $candidate : null;
        $key = $request->getHeaderLine('Idempotency-Key');
        return new ApiException(
            $error->getMessage(),
            $response?->getStatusCode() ?? 0,
            $response?->getHeaders() ?? [],
            null !== $response ? (string) $response->getBody() : null,
            '' === $key ? null : $key,
            $error,
        );
    }
}
