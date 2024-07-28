<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Subnet\Service\Downloader;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
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

#[Autoconfigure]
final readonly class HttpDownloader implements DownloaderInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer,
        private EventDispatcherInterface $eventDispatcher,
    ) {}

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
                ->dispatch(new DownloaderRequestEvent($processState, $statusCode, $request, $response, $exception));
        }
    }
}
