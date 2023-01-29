<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Unit\Command\Subnet;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnBlockerService\Command\Subnet\DownloadSubnetListCommand;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;
use UnBlockerService\Domain\Subnet\Publisher\EventPublisherInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\DownloaderInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\Exception\DownloaderException;
use UnBlockerService\Infrastructure\Subnet\Service\Downloader\Serializer\ListSerializer;
use UnBlockerService\Tests\Helper\TestHelper;

test('Test DownloadSubnetListCommand', function (array $providerList, string $subnets, string $country, int $expectedCommandStatus, ?\Throwable $expectedException): void {
    $downloader = $this->createMock(DownloaderInterface::class);
    $eventPublisher = $this->createMock(EventPublisherInterface::class);
    $clockManipulator = $this->createMock(ClockManipulatorInterface::class);
    $input = $this->createMock(InputInterface::class);
    $output = $this->createMock(OutputInterface::class);
    $subnetList = (new ListSerializer())->deserialize($subnets, $country);
    $countOfProviderList = \count($providerList);

    $expectedException
        ? $downloader
            ->expects($this->once())
            ->method('download')
            ->willThrowException($expectedException)
        : $downloader
            ->expects($this->exactly($countOfProviderList))
            ->method('download')
            ->willReturn($subnetList)
    ;

    $eventPublisher
        ->expects($expectedException ? $this->never() : $this->exactly(\count($subnetList) + 1))
        ->method('publish')
    ;

    $clockManipulator
        ->expects($expectedException ? $this->never() : $this->exactly(\count($subnetList)))
        ->method('now')
        ->willReturn(new \DateTimeImmutable())
    ;

    $clockManipulator
        ->expects($expectedException ? $this->never() : $this->once())
        ->method('nowAsFormatted')
        ->willReturn((new \DateTimeImmutable())->format(\DateTimeInterface::RFC3339))
    ;

    $executedCommandStatus = (new DownloadSubnetListCommand($downloader, $eventPublisher, $clockManipulator, $providerList))
        ->run($input, $output)
    ;

    expect($executedCommandStatus)->toBe($expectedCommandStatus);
})->with(function () {
    yield 'Test UA provider with UA subnets success' => [
        'providerList' => [TestHelper::PROVIDER_UA],
        'subnets' => TestHelper::getTestSubnetsAsString(TestHelper::COUNTRY_UA),
        'country' => TestHelper::COUNTRY_UA,
        'expectedCommandStatus' => Command::SUCCESS,
        'expectedException' => null,
    ];

    yield 'Test USA provider with USA subnets success' => [
        'providerList' => [TestHelper::PROVIDER_USA],
        'subnets' => TestHelper::getTestSubnetsAsString(TestHelper::COUNTRY_USA),
        'country' => TestHelper::COUNTRY_USA,
        'expectedCommandStatus' => Command::SUCCESS,
        'expectedException' => null,
    ];

    yield 'Test USA provider with USA subnets failure' => [
        'providerList' => [TestHelper::PROVIDER_USA],
        'subnets' => TestHelper::getTestSubnetsAsString(TestHelper::COUNTRY_USA),
        'country' => TestHelper::COUNTRY_USA,
        'expectedCommandStatus' => Command::FAILURE,
        'expectedException' => new DownloaderException(TestHelper::MESSAGE),
    ];
});
