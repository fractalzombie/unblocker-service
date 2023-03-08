<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Subnet\Service\Downloader;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use UnBlockerService\Domain\Common\Enum\HttpMethod;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Common\Enum\StatusCode;
use UnBlockerService\Domain\Subnet\Service\Downloader\DownloaderInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\Exception\DownloaderException;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\SerializerInterface;
use UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event\DownloaderRequestEvent;

#[AsService]
final readonly class HttpDownloader implements DownloaderInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function download(Request $request): array
    {
        try {
            $processState = ProcessState::Success;
            $statusCode = StatusCode::Ok;
            $response = $this->client->request(HttpMethod::GET, $request->url);

            return $this->serializer->deserialize($response->getContent(), $request->country);
        } catch (ClientException $exception) {
            $processState = ProcessState::Failure;
            $response = $exception->getResponse();
            $statusCode = StatusCode::tryFrom($response->getStatusCode()) ?? StatusCode::InternalServerError;

            throw DownloaderException::fromThrowable($exception);
        } catch (\Throwable $exception) {
            $processState = ProcessState::Failure;
            $statusCode = StatusCode::InternalServerError;

            throw DownloaderException::fromThrowable($exception);
        } finally {
            $response ??= null;
            $exception ??= null;

            $this->eventDispatcher
                ->dispatch(new DownloaderRequestEvent($processState, $statusCode, $request, $response, $exception))
            ;
        }
    }
}
