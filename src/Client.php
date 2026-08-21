<?php

declare(strict_types=1);

namespace ProxyRequest;

use Closure;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use ProxyRequest\Resource\AffiliatesResource;
use ProxyRequest\Resource\AnalyticsResource;
use ProxyRequest\Resource\APIKeysResource;
use ProxyRequest\Resource\AuthorizationResource;
use ProxyRequest\Resource\CouponsResource;
use ProxyRequest\Resource\InvoicesResource;
use ProxyRequest\Resource\LocationsResource;
use ProxyRequest\Resource\NewsResource;
use ProxyRequest\Resource\OrdersResource;
use ProxyRequest\Resource\PackagesResource;
use ProxyRequest\Resource\ProfileResource;
use ProxyRequest\Resource\ProxiesResource;
use ProxyRequest\Resource\RewardsResource;
use ProxyRequest\Resource\SessionsResource;
use ProxyRequest\Resource\SettingsResource;
use ProxyRequest\Resource\TelegramDashboardResource;
use ProxyRequest\Resource\TelegramDashboardServiceResource;
use ProxyRequest\Resource\UsersResource;
use ProxyRequest\Resource\WebhooksResource;
use ProxyRequest\Support\FileDownload;
use ProxyRequest\Support\Paginator;
use Psr\Http\Message\ResponseInterface;
use SplFileObject;
use UnexpectedValueException;

final class Client
{
    public const VERSION = '1.0.0';
    public const USER_AGENT = 'proxyrequest-php/' . self::VERSION;

    /** @var array<class-string, object> */
    private array $resources = [];

    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly Configuration $configuration,
        private readonly string $language = 'en',
    ) {}

    public static function builder(): ClientBuilder
    {
        return new ClientBuilder();
    }

    public static function withApiKey(string $apiKey, string $baseUri = 'https://api.proxyrequest.com/api/v1'): self
    {
        return self::builder()->withApiKey($apiKey)->withBaseUri($baseUri)->build();
    }

    public static function withBearerToken(string $token, string $baseUri = 'https://api.proxyrequest.com/api/v1'): self
    {
        return self::builder()->withBearerToken($token)->withBaseUri($baseUri)->build();
    }

    public static function anonymous(string $baseUri = 'https://api.proxyrequest.com/api/v1'): self
    {
        return self::builder()->anonymous()->withBaseUri($baseUri)->build();
    }

    public function apiKeys(): APIKeysResource
    {
        return $this->resource(APIKeysResource::class);
    }

    public function affiliates(): AffiliatesResource
    {
        return $this->resource(AffiliatesResource::class);
    }

    public function analytics(): AnalyticsResource
    {
        return $this->resource(AnalyticsResource::class);
    }

    public function authorization(): AuthorizationResource
    {
        return $this->resource(AuthorizationResource::class);
    }

    public function coupons(): CouponsResource
    {
        return $this->resource(CouponsResource::class);
    }

    public function invoices(): InvoicesResource
    {
        return $this->resource(InvoicesResource::class);
    }

    public function locations(): LocationsResource
    {
        return $this->resource(LocationsResource::class);
    }

    public function news(): NewsResource
    {
        return $this->resource(NewsResource::class);
    }

    public function orders(): OrdersResource
    {
        return $this->resource(OrdersResource::class);
    }

    public function packages(): PackagesResource
    {
        return $this->resource(PackagesResource::class);
    }

    public function profile(): ProfileResource
    {
        return $this->resource(ProfileResource::class);
    }

    public function proxies(): ProxiesResource
    {
        return $this->resource(ProxiesResource::class);
    }

    public function rewards(): RewardsResource
    {
        return $this->resource(RewardsResource::class);
    }

    public function sessions(): SessionsResource
    {
        return $this->resource(SessionsResource::class);
    }

    public function settings(): SettingsResource
    {
        return $this->resource(SettingsResource::class);
    }

    public function telegram(): TelegramDashboardResource
    {
        return $this->resource(TelegramDashboardResource::class);
    }

    public function telegramService(): TelegramDashboardServiceResource
    {
        return $this->resource(TelegramDashboardServiceResource::class);
    }

    public function users(): UsersResource
    {
        return $this->resource(UsersResource::class);
    }

    public function webhooks(): WebhooksResource
    {
        return $this->resource(WebhooksResource::class);
    }

    /**
     * @param Closure(int, int): object $pageFetcher
     * @return Paginator<mixed>
     */
    public function paginate(Closure $pageFetcher, int $limit = 100, int $offset = 0): Paginator
    {
        return new Paginator($pageFetcher, $limit, $offset);
    }

    public function downloadInvoicePdf(string $invoiceId, ?string $acceptLanguage = null): FileDownload
    {
        $file = $this->invoices()->downloadPdf($invoiceId, $acceptLanguage ?? $this->language);

        if (!$file instanceof SplFileObject) {
            throw new UnexpectedValueException('The invoice endpoint did not return a PDF file.');
        }

        return new FileDownload($file, \sprintf('invoice-%s.pdf', $invoiceId), 'application/pdf');
    }

    /**
     * Escape hatch for endpoints added before the next SDK release.
     *
     * @param array<string, scalar|list<scalar>|null> $query
     * @param array<string, string> $headers
     * @param array<string, mixed>|null $json
     */
    public function raw(
        string $method,
        string $path,
        array $query = [],
        ?array $json = null,
        array $headers = [],
    ): ResponseInterface {
        $uri = rtrim($this->configuration->getHost(), '/') . '/' . ltrim($path, '/');
        $filteredQuery = array_filter($query, static fn(mixed $value): bool => null !== $value);

        if ([] !== $filteredQuery) {
            $uri .= '?' . http_build_query($filteredQuery, '', '&', PHP_QUERY_RFC3986);
        }

        $headers += [
            'Accept' => 'application/json',
            'Accept-Language' => $this->language,
            'User-Agent' => self::USER_AGENT,
        ];

        $authorization = $this->configuration->getApiKeyWithPrefix('Authorization');
        if (null === $authorization && '' !== $this->configuration->getAccessToken()) {
            $authorization = 'Bearer ' . $this->configuration->getAccessToken();
        }
        if (null !== $authorization) {
            $headers['Authorization'] = $authorization;
        }

        $body = null;
        if (null !== $json) {
            $headers['Content-Type'] = 'application/json';
            $body = json_encode($json, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        }

        return $this->httpClient->send(new Request(strtoupper($method), $uri, $headers, $body), [
            'http_errors' => true,
        ]);
    }

    /** @return array{baseUri: string, language: string, resources: list<string>} */
    public function __debugInfo(): array
    {
        return [
            'baseUri' => $this->configuration->getHost(),
            'language' => $this->language,
            'resources' => array_keys($this->resources),
        ];
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T
     */
    private function resource(string $class): object
    {
        /** @var T */
        return $this->resources[$class] ??= new $class($this->httpClient, $this->configuration);
    }
}
