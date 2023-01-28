<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Subnet\Service\Downloader;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use UnBlockerService\Common\Domain\Enum\HttpMethod;
use UnBlockerService\Subnet\Domain\Service\Downloader\DownloaderInterface;
use UnBlockerService\Subnet\Domain\Service\Downloader\Exception\DownloaderException;
use UnBlockerService\Subnet\Domain\Service\Downloader\Request\Request;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\SerializerInterface;

#[AsService]
final readonly class HttpDownloader implements DownloaderInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer,
    ) {
    }

    public function download(Request $request): array
    {
        try {
            $response = $this->client->request(HttpMethod::GET, $request->url);

            return $this->serializer->deserialize($response->getContent(), $request->country);
        } catch (\Throwable $e) {
            throw DownloaderException::fromThrowable($e);
        }
    }
}
