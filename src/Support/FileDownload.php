<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use RuntimeException;
use SplFileObject;

final readonly class FileDownload
{
    public function __construct(
        private SplFileObject $file,
        public string $filename,
        public string $contentType,
    ) {}

    public function size(): int
    {
        return $this->file->getSize();
    }

    public function contents(): string
    {
        $this->file->rewind();
        $contents = '';
        while (!$this->file->eof()) {
            $contents .= $this->file->fread(8192);
        }

        return $contents;
    }

    public function saveTo(string $path): void
    {
        if ('' === trim($path)) {
            throw new RuntimeException('The destination path must not be empty.');
        }

        $destination = fopen($path, 'wb');
        if (false === $destination) {
            throw new RuntimeException(\sprintf('Unable to open "%s" for writing.', $path));
        }

        try {
            $this->file->rewind();
            while (!$this->file->eof()) {
                $chunk = $this->file->fread(8192);
                if (false === $chunk) {
                    throw new RuntimeException('Unable to read the downloaded file.');
                }
                if (false === fwrite($destination, $chunk)) {
                    throw new RuntimeException(\sprintf('Unable to write the complete download to "%s".', $path));
                }
            }
        } finally {
            fclose($destination);
        }
    }
}
