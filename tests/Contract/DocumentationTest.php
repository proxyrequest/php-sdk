<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Contract;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversNothing]
final class DocumentationTest extends TestCase
{
    /** @var list<string> */
    private const DOCUMENTATION_FILES = [
        'README.md',
        'docs/Guides/PurchaseFlow.md',
        'docs/Guides/ResellerProvisioning.md',
    ];

    /** @var list<string> */
    private const REQUIRED_OFFICIAL_LINKS = [
        'https://proxyrequest.com/docs/',
        'https://proxyrequest.com/docs/integration/overview/',
        'https://proxyrequest.com/docs/integration/api-fundamentals/',
        'https://proxyrequest.com/docs/integration/api-resource-map/',
        'https://proxyrequest.com/docs/integration/billing-and-growth/',
        'https://proxyrequest.com/docs/integration/reseller-workflow/',
        'https://proxyrequest.com/docs/integration/users-and-data/',
        'https://proxyrequest.com/docs/integration/catalog-and-proxies/',
        'https://proxyrequest.com/docs/integration/webhooks/',
        'https://proxyrequest.com/docs/proxy/usage-accounting/',
        'https://proxyrequest.com/docs/api/',
    ];

    public function testRequiredDocumentationAndOfficialLinksArePresent(): void
    {
        $combined = '';

        foreach (self::DOCUMENTATION_FILES as $relativePath) {
            $path = self::root() . '/' . $relativePath;
            self::assertFileExists($path);
            $combined .= self::read($path);
        }

        foreach (self::REQUIRED_OFFICIAL_LINKS as $link) {
            self::assertStringContainsString($link, $combined);
        }
    }

    public function testLocalMarkdownLinksResolve(): void
    {
        foreach (self::DOCUMENTATION_FILES as $relativePath) {
            $source = self::root() . '/' . $relativePath;
            $contents = self::read($source);
            $matchCount = preg_match_all('/(?<!!)\[[^]]+]\(([^)\s]+)\)/', $contents, $matches);

            if (false === $matchCount) {
                throw new RuntimeException('Unable to parse Markdown links in ' . $relativePath);
            }

            /** @var list<string> $targets */
            $targets = $matches[1];

            foreach ($targets as $target) {
                if ('#' === $target[0] || preg_match('/^[a-z][a-z0-9+.-]*:/i', $target)) {
                    continue;
                }

                $localTarget = explode('#', $target, 2)[0];
                $resolved = \dirname($source) . '/' . rawurldecode($localTarget);

                self::assertFileExists(
                    $resolved,
                    \sprintf('Broken local link "%s" in %s.', $target, $relativePath),
                );
            }
        }
    }

    public function testDocumentedPhpExamplesHaveValidSyntax(): void
    {
        foreach (self::DOCUMENTATION_FILES as $relativePath) {
            $contents = self::read(self::root() . '/' . $relativePath);
            $matchCount = preg_match_all('/```php[^\r\n]*\R(.*?)```/s', $contents, $matches);

            if (false === $matchCount) {
                throw new RuntimeException('Unable to parse PHP examples in ' . $relativePath);
            }

            self::assertGreaterThan(0, $matchCount, 'No PHP examples found in ' . $relativePath);

            /** @var list<string> $examples */
            $examples = $matches[1];

            foreach ($examples as $index => $example) {
                $source = str_starts_with(ltrim($example), '<?php')
                    ? $example
                    : "<?php\n" . $example;
                $temporaryFile = tempnam(sys_get_temp_dir(), 'proxyrequest-doc-');

                if (false === $temporaryFile) {
                    throw new RuntimeException('Unable to create a temporary PHP file.');
                }

                try {
                    if (false === file_put_contents($temporaryFile, $source)) {
                        throw new RuntimeException('Unable to write a temporary PHP file.');
                    }

                    $output = [];
                    $exitCode = 0;
                    exec(
                        escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($temporaryFile) . ' 2>&1',
                        $output,
                        $exitCode,
                    );

                    self::assertSame(
                        0,
                        $exitCode,
                        \sprintf(
                            "Invalid PHP example %d in %s:\n%s",
                            $index + 1,
                            $relativePath,
                            implode(PHP_EOL, $output),
                        ),
                    );
                } finally {
                    unlink($temporaryFile);
                }
            }
        }
    }

    private static function root(): string
    {
        return \dirname(__DIR__, 2);
    }

    private static function read(string $path): string
    {
        $contents = file_get_contents($path);

        if (false === $contents) {
            throw new RuntimeException('Unable to read ' . $path);
        }

        return $contents;
    }
}
